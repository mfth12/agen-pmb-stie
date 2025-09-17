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
      return redirect()->route('dashboard.index'); // ini redirect ke dasbor, BUKAN '/'
    }

    return view('sistem.masuk', [
      'title'     => konfigs('NAMA_SISTEM'),
    ]);
  }


  /**
   * Proses login menggunakan API SIAKAD
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
        'masuk' => 'Silakan coba lagi dalam <span id="countdown">' . $seconds . '</span> detik.',
      ]);
    }
    
    // Ambil kredensi
    $credentials = $request->only('username', 'password');

    // Lakukan try catch ke endpoint API SIAKAD
    try {
      $response = Http::timeout(10)->post(env('URL_API_SIAKAD') . '/api/v2/auth/login', $credentials);
    } catch (Exception $e) {
      RateLimiter::hit($throttleKey, $decaySeconds); // ❌ Tambah hit saat koneksi gagal
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
      RateLimiter::clear($throttleKey); // ✅ Reset limit jika berhasil login

      $access_token = $data['access_token'];
      $userData = $data['user'];

      // Cari atau buat user di sistem e-Skripsi
      $user = User::updateOrCreate(
        ['siakad_id' => $userData['id']],
        [
          'siakad_id'         => $userData['id'],
          'username'          => $userData['username'], //not used
          // 'password'          => $userData['password'], //not used
          'email'             => $userData['email'],
          'name'              => $userData['name'],
          'nomor_hp'          => $userData['nomor_hp'],
          'nomor_hp2'         => $userData['nomor_hp2'],
          'email_verified_at' => $userData['email_verified_at'],
          'about'             => $userData['about'],
          // 'role'              => $userData['default_role'], //not used
          'default_role'      => $userData['default_role'],
          'theme'             => $userData['theme'],
          'avatar'            => $userData['avatar'],
          'status'            => $userData['status'],
          'status_login'      => $userData['status_login'],
          'isdeleted'         => $userData['isdeleted'],
          'last_logged_in'     => Carbon::now(),
          'last_synced_at'    => Carbon::now(),
          // 'rememberToken'     => $userData['rememberToken'], //not used
          // 'created_at'        => $userData['created_at'], //not used
          // 'updated_at'        => $userData['updated_at'], //not used
        ]
      );

      // Simpan access_token ke session
      Session::put('api_access_token', $access_token);
      Session::put('api_userroles', $userData['roles']); //menyimpan roles dari siakad

      // Sinkronisasi roles dari default siakad:
      // dd($userData['roles']);
      $skripsi_role = $userData['default_role'] ?? [];
      if (!is_array($skripsi_role)) {
        $skripsi_role = [$skripsi_role]; // ubah jadi array jika perlu
      }
      $user->syncRoles($skripsi_role); // langsung sync ke sistem


      Auth::login($user);
      return redirect()->intended(route('dashboard.index'));
    }

    // Hit jika gagal login
    RateLimiter::hit($throttleKey, $decaySeconds); // ❌ Tambah hit kalau login gagal

    // Tampilkan error dari API
    $errorMessage = "Tidak dapat melakukan otentikasi";
    if (isset($data['message'])) {
      if (is_array($data['message'])) {
        // Jika `message` berupa array verifikasi, gabungkan menjadi string
        $errorMessage = implode('. ', array_map(fn($msg) => implode(' ', $msg), $data['message']));
      } else {
        // Jika `message` berupa string biasa
        $errorMessage = $data['message'];
      }
    }

    // Kembalikan pesan eror
    return back()->withErrors(['masuk' => $errorMessage . "."]);
  }


  /**
   * Proses logout
   */
  public function keluar(): RedirectResponse
  {
    // Hapus session
    Session::forget('api_access_token');
    Session::forget('api_userroles'); //not used
    Auth::logout();

    // Redirect ke halaman login
    return redirect()->route('masuk')->with('keluar', 'Anda telah keluar sistem');
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
