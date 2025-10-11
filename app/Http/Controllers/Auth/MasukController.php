<?php

namespace App\Http\Controllers\Auth;

use Exception;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Auth\Events\Lockout;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;

class MasukController extends Controller
{
  /**
   * Menampilkan halaman login
   */
  public function index(): View|RedirectResponse
  {
    if (Auth::check()) {
      return redirect()->route('dashboard.index');
    }

    return view('sistem.masuk', [
      'title'     => 'Masuk ' . konfigs('NAMA_SISTEM_ALIAS'),
    ]);
  }

  /**
   * Proses login menggunakan API SIAKAD atau lokal
   */
  public function masuk(LoginRequest $request): RedirectResponse
  {
    // Rate limit dulu berdasarkan username + IP
    $throttleKey = Str::transliterate(Str::lower($request->string('username')) . '|' . $request->ip());
    $maxAttempts = (int) env('LOGIN_MAX_ATTEMPTS', 3);
    $decaySeconds = (int) env('LOGIN_DECAY_SECONDS', 120);

    if (RateLimiter::tooManyAttempts($throttleKey, $maxAttempts)) {
      event(new Lockout($request));
      $seconds = RateLimiter::availableIn($throttleKey);

      throw ValidationException::withMessages([
        'masuk' => 'Silakan coba lagi dalam <span id="countdown" style="margin: -10px">' . $seconds . '</span> detik.',
      ]);
    }

    // Ambil kredensial
    $credentials = $request->only('username', 'password', 'via_siakad');

    // Cek status via_siakad
    if ($credentials['via_siakad'] == 1) {
      // Login via SIAKAD
      return $this->loginViaSiakad($request, $credentials, $throttleKey, $decaySeconds);
    } else {
      // Login lokal ke database user
      return $this->loginLocal($request, $credentials, $throttleKey, $decaySeconds);
    }
  }

  /**
   * Login via API SIAKAD
   */
  protected function loginViaSiakad($request, $credentials, $throttleKey, $decaySeconds): RedirectResponse
  {
    // Lakukan try catch ke endpoint API SIAKAD
    try {
      $response = Http::timeout(10)->post(env('URL_API_SIAKAD') . '/api/v2/auth/login', [
        'username' => $credentials['username'],
        'password' => $credentials['password']
      ]);
    } catch (Exception $e) {
      RateLimiter::hit($throttleKey, $decaySeconds);
      return back()->withErrors(['koneksi' => 'Gagal menghubungi layanan Siakad.']);
    }

    $data = $response->json();

    // Verifikasi Turnstile
    if (env('USING_TURNSTILE', true)) {
      $turnstileResponse = $request->input('cf-turnstile-response');
      if (!$turnstileResponse) {
        return back()->withErrors(['turnstile_notvalid' => 'Wajib verifikasi keamanan']);
      }
      $turnstileValid = $this->validateTurnstile($turnstileResponse, $request->ip());
      if (!$turnstileValid) {
        return back()->withErrors(['turnstile_notvalid' => 'Verifikasi keamanan gagal']);
      }
    }

    // Jika login berhasil
    if ($response->successful() && isset($data['access_token']) && isset($data['user'])) {
      RateLimiter::clear($throttleKey);

      $access_token = $data['access_token'];
      $userData = $data['user'];

      // Cari atau buat user di sistem
      $user = User::updateOrCreate(
        ['siakad_id' => $userData['id']],
        [
          'siakad_id'         => $userData['id'],
          'username'          => $userData['username'],
          'password'          => null, // Jangan simpan password dari Siakad
          'email'             => $userData['email'],
          'name'              => $userData['name'],
          'nomor_hp'          => $userData['nomor_hp'],
          'nomor_hp2'         => $userData['nomor_hp2'],
          'email_verified_at' => $userData['email_verified_at'],
          'about'             => $userData['about'],
          'default_role'      => $userData['default_role'],
          'theme'             => $userData['theme'],
          'avatar'            => $userData['avatar'],
          'status'            => $userData['status'],
          'status_login'      => $userData['status_login'],
          'isdeleted'         => $userData['isdeleted'],
          'last_logged_in'    => Carbon::now(),
          'last_synced_at'    => Carbon::now(),
        ]
      );

      // Untuk user lain, assign role berdasarkan default_role dari Siakad
      $agen_role = $userData['default_role'] ?? 'mahasiswa';
      if (!is_array($agen_role)) {
        $agen_role = [$agen_role];
      }

      $user->syncRoles($agen_role);

      // Simpan access_token ke session
      Session::put('api_access_token', $access_token);
      Session::put('api_userroles', $userData['roles']);

      Auth::login($user);
      return redirect()->intended(route('dashboard.index'));
    }

    // Hit jika gagal login
    RateLimiter::hit($throttleKey, $decaySeconds);

    // Tampilkan error dari API
    $errorMessage = "Tidak dapat melakukan otentikasi";
    if (isset($data['message'])) {
      if (is_array($data['message'])) {
        $errorMessage = implode('. ', array_map(fn($msg) => implode(' ', $msg), $data['message']));
      } else {
        $errorMessage = $data['message'];
      }
    }

    return back()->withErrors(['masuk' => $errorMessage . "."]);
  }

  /**
   * Login lokal ke database user
   */
  protected function loginLocal($request, $credentials, $throttleKey, $decaySeconds): RedirectResponse
  {
    // Verifikasi Turnstile untuk login lokal juga
    if (env('USING_TURNSTILE', true)) {
      $turnstileResponse = $request->input('cf-turnstile-response');
      if (!$turnstileResponse) {
        return back()->withErrors(['turnstile_notvalid' => 'Wajib verifikasi keamanan']);
      }
      $turnstileValid = $this->validateTurnstile($turnstileResponse, $request->ip());
      if (!$turnstileValid) {
        return back()->withErrors(['turnstile_notvalid' => 'Verifikasi keamanan gagal']);
      }
    }

    // Coba login dengan kredensial lokal
    if (Auth::attempt([
      'username' => $credentials['username'],
      'password' => $credentials['password'],
      'status' => 'active'
    ], $request->boolean('remember'))) {

      RateLimiter::clear($throttleKey);

      // Update last logged in
      $user = Auth::user();
      $user->update([
        'last_logged_in' => Carbon::now(),
        'status_login' => 'online'
      ]);

      return redirect()->intended(route('dashboard.index'));
    }

    // Hit jika gagal login
    RateLimiter::hit($throttleKey, $decaySeconds);

    return back()->withErrors([
      'masuk' => 'Username atau password salah.',
    ]);
  }

  /**
   * Proses logout
   */
  public function keluar(): RedirectResponse
  {
    // Update status login user
    if (Auth::check()) {
      Auth::user()->update([
        'status_login' => 'offline'
      ]);
    }

    // Hapus session
    Session::forget('api_access_token');
    Session::forget('api_userroles');
    Auth::logout();

    return redirect()->route('login')->with('keluar', 'Anda telah keluar sistem');
  }

  /**
   * Fungsi untuk memverifikasi Turnstile.
   */
  protected function validateTurnstile(string $response, string $ip): bool
  {
    $apiResponse = Http::asForm()->post('https://challenges.cloudflare.com/turnstile/v0/siteverify', [
      'secret' => env('TURNSTILE_SECRET_KEY'),
      'response' => $response,
      'remoteip' => $ip,
    ]);
    return $apiResponse->json()['success'] ?? false;
  }
}
