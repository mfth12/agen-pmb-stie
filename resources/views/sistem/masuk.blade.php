@extends('components.theme.masuk')

@section('container')
  <div class="card card-outline card-secondary">
    <div class="card-header text-center">
      <h2>{{ session('konfigs')['nama_sistem'] }}</h2>
    </div>
    <div class="card-body mx-auto">
      <div class="text-center mb-3">
        <img src="{{ asset('img/' . session('konfigs')['logo_lembaga']) }}" alt=""
          style="width: 150px;"draggable="false">
      </div>
      <p class="login-box-msg">Masuk untuk mendapatkan akses ke
        {{ session('konfigs')['nama_sistem'] . ' ' . session('konfigs')['nama_lembaga'] }}.</p>

      {{-- kalau ada error di password --}}
      @error('password')
        <div class="alert alert-hilang alert-danger alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <i class="fa-solid fa-triangle-exclamation mr-2"></i>{{ $message }}
        </div>
      @enderror

      {{-- flash gagal masuk --}}
      @if (session()->has('masukGagal'))
        <div class="alert alert-hilang alert-danger alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <i class="fa-solid fa-triangle-exclamation mr-2"></i>{{ session('masukGagal') }}
        </div>
      @endif

      {{-- flash gagal masuk --}}
      @if (session()->has('masukLimited'))
        <div class="alert alert-hilang alert-danger alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <i class="fa-solid fa-triangle-exclamation mr-2"></i>
          Coba lagi dalam <span id="waktu">{{ session('masukLimited') }}</span> detik
          <script>
            let detik = {{ session('masukLimited') }};
            const el = document.getElementById('waktu');
            setInterval(() => {
              if (detik > 0) {
                detik--;
                el.textContent = detik;
              }
            }, 1000);
          </script>
        </div>
      @endif

      {{-- flash kosong masuk --}}
      @if (session()->has('masukKosong'))
        <div class="alert alert-hilang alert-danger alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <i class="fa-solid fa-key mr-2"></i>{{ session('masukKosong') }}
        </div>
      @endif

      {{-- flash no-user --}}
      @if (session()->has('nouser'))
        <div class="alert alert-hilang alert-danger alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <i class="fa-solid fa-ban mr-2"></i>{{ session('nouser') }}
        </div>
      @endif

      {{-- flash keluar user --}}
      @if (session()->has('keluar'))
        <div class="alert alert-hilang alert-secondary alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <i class="fa-solid fa-lock mr-2"></i>{{ session('keluar') }}
        </div>
      @endif

      <form action="{{ route('masuk') }}" method="POST">
        @csrf
        @honeypot
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="NPPY" name="nomer_induk"
            value="{{ old('nomer_induk') }}" autofocus>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Sandi" name="password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>

        {{-- clouflare turnstile script begin --}}
        @if (env('USING_TURNSTILE', false))
          <div style="position: relative; height: 65px;"> {{-- Container pembungkus relatif --}}
  <div class="cf-turnstile"
       style="position: absolute; left: 50%; transform: translateX(-50%); min-width: 300px; width: max-content;"
       data-sitekey="{{ env('TURNSTILE_SITE_KEY') }}"
       data-size="flexible"
       data-refresh-expired="auto"
       data-callback="javascriptCallback"
       data-theme="light"
       data-language="{{ env('TURNSTILE_LANGUAGE', 'en-US') }}">
  </div>
</div>

        @endif
        <hr>
        {{-- end of clouflare script --}}
        <div class="row d-flex justify-content-center">
          <div class="col-md-6 col-6"> <!-- Kolom baru untuk menempatkan tombol "Panduan" -->
            <a href="{{ url('/panduan') }}" class="btn btn-default btn-block">
              Panduan<i class="fas fa-book ml-1"></i>
            </a>
          </div>
          <div class="col-md-6 col-6"> <!-- Kolom baru untuk menempatkan tombol "Panduan" -->
            <button type="submit" id="tombolmasuk" class="btn btn-primary btn-block">
              Masuk<i class="fas fa-arrow-right ml-1"></i>
            </button>
          </div>
        </div>
      </form>
      <p class="mt-4 text-center text-muted text-sm" style="margin-bottom: 0px">
        Copyright © {{ now()->year }} <a href="{{ session('konfigs')['website_resmi'] }}" target="_blank"
          style="color: darkslategray" data-toggle="tooltip" data-original-title="Kunjungi Situs">
          {{ session('konfigs')['nama_lembaga'] }}</a>. {{ config('app.version') }}
      </p>
    </div>
  </div>
@endsection
