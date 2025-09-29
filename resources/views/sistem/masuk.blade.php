@extends('components.theme.front')

@section('container')
  <div class="page page-center">
    <div class="container container-normal py-4">
      <div class="row align-items-center g-4">
        {{--  --}}
        <div class="col-lg">
          <div class="container-tight py-9">
            <div class="text-center mb-2">
              <a href="javascript:void()" aria-label="{{ konfigs('NAMA_SISTEM_ALIAS') }}"
                class="navbar-brand navbar-brand-autodark d-flex align-items-center justify-content-center">
                <span class=" d-flex align-items-center">
                  @include('components.back.macros', ['height' => 20, 'withbg' => 'fill: #fff;'])
                </span>
                <h1 class="mb-0">{{ konfigs('NAMA_SISTEM_ALIAS') }}</h1>
              </a>
            </div>
            <h3 class="text-center mb-4">{{ konfigs('NAMA_SISTEM') }}</h3>
            <div class="card card-md">
              <div class="card-body">
                {{-- ALERTS --}}
                @if ($errors->has('masuk'))
                  <div
                    class="alert alert-hilang alert-danger text-danger alert-dismissible d-flex align-items-center animate__animated animate__shakeX"
                    role="alert">
                    <div class="alert-icon">
                      <i class="ti ti-ban fs-2 text-danger"></i>
                    </div>
                    {!! $errors->first('masuk') !!}
                    <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
                  </div>
                @elseif ($errors->has('koneksi'))
                  <div
                    class="alert alert-hilang alert-danger text-danger alert-dismissible d-flex align-items-center animate__animated animate__shakeX"
                    role="alert">
                    <div class="alert-icon">
                      <i class="ti ti-plug-connected-x fs-2 text-danger"></i>
                    </div>
                    {!! $errors->first('koneksi') !!} asd
                    <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
                  </div>
                @elseif ($errors->has('turnstile_notvalid'))
                  <div
                    class="alert alert-hilang alert-danger text-danger alert-dismissible d-flex align-items-center animate__animated animate__shakeX"
                    role="alert">
                    <div class="alert-icon">
                      <i class="ti ti-cloud-x fs-2 text-danger"></i>
                    </div>
                    {!! $errors->first('turnstile_notvalid') !!}
                    <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
                  </div>
                @elseif (session()->has('no_session'))
                  <div
                    class="alert alert-hilang alert-danger text-danger alert-dismissible d-flex align-items-center animate__animated animate__shakeX"
                    role="alert">
                    <div class="alert-icon">
                      <i class="ti ti-ban fs-2 text-danger"></i>
                    </div>
                    {!! session('no_session') !!}
                    <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
                  </div>
                @elseif (session()->has('keluar'))
                  <div
                    class="alert alert-hilang alert-secondary text-secondary alert-dismissible d-flex align-items-center"
                    role="alert">
                    <div class="alert-icon">
                      <i class="ti ti-lock fs-2 text-secondary"></i>
                    </div>
                    {!! session('keluar') !!}
                    <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
                  </div>
                @else
                  <div class="alert alert-hilang alert-info text-info d-flex align-items-center" role="alert">
                    <i class="ti ti-fingerprint fs-2 text-info"></i>
                    Gunakan Akun Siakad Anda untuk masuk.
                  </div>
                @endif
                {{-- END OF ALERTS --}}

                {{-- LOGIN FORM --}}
                {!! html()->form('post')->route('login.do')->attributes(['name' => 'formAuthentication', 'id' => 'formAuthentication', 'class' => 'mb-0 mt-0'])->open() !!}
                <div class="mb-2">
                  <label class="form-label">Username</label>
                  {!! html()->text('username')->class('form-control' . ($errors->has('username') ? ' is-invalid' : ''))->placeholder('Username Siakad')->attributes(['aria-describedby' => 'username']) !!}
                </div>
                <div class="mb-2">
                  <label class="form-label">
                    Password
                    <span class="form-label-description"><a href="/lupa-password" class="text-muted">
                        Lupa password?</a>
                    </span>
                  </label>
                  <div class="input-group">
                    {!! html()->password('password')->class('form-control' . ($errors->has('password') ? ' is-invalid' : ''))->placeholder('&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;')->id('password')->attributes(['aria-describedby' => 'toggle-password', 'autocomplete' => 'off']) !!}
                  </div>
                </div>
                {{-- Clouflare turnstile script --}}
                @if (env('USING_TURNSTILE', false))
                  <div class="mt-4" style="display: block; flex-flow: row;">
                    <div class="cf-turnstile" style="min-width: 100px;" data-sitekey="{{ env('TURNSTILE_SITE_KEY') }}"
                      data-size="flexible" data-refresh-expired="auto" data-callback="javascriptCallback"
                      data-theme="light" data-language="{{ env('TURNSTILE_LANGUAGE', 'en-US') }}">
                    </div>
                  </div>
                @endif

                {{-- Submit button --}}
                <div class="form-footer">
                  {!! html()->button(
                          '<span><span class="button-text">Masuk</span><div class="spinner-border spinner-border-sm ms-2 d-none " role="status"></div></span>',
                          'submit',
                      )->class('btn btn-primary d-grid w-100')->id('loginButton') !!}
                </div>

                {!! html()->form()->close() !!}
                {{-- END OF LOGIN FORM --}}
              </div>
            </div>
            <div class="text-center text-secondary mt-3">
              Copyright © {{ now()->year }}
              <a href="https://www.stie-pembangunan.ac.id/" target="_blank" data-bs-toggle="tooltip"
                data-bs-placement="top" title="Kunjungi situs">STIE Pembangunan Tanjungpinang</a>.
              {{ env('APP_VERSION') }}
            </div>
          </div>
        </div>

        <div class="col-lg d-none d-lg-block">
          <img src="{{ Vite::asset('resources/img/login-illustration.png') }}" alt="Login Illustration">
        </div>
      </div>
    </div>
  </div>

  <div class="settings">
    <a href="#" class="btn btn-floating btn-icon btn-primary" data-bs-toggle="offcanvas"
      data-bs-target="#offcanvasSettings" aria-controls="offcanvasSettings" aria-label="Theme Settings">
      <!-- Download SVG icon from http://tabler.io/icons/icon/brush -->
      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-1">
        <path d="M3 21v-4a4 4 0 1 1 4 4h-4" />
        <path d="M21 3a16 16 0 0 0 -12.8 10.2" />
        <path d="M21 3a16 16 0 0 1 -10.2 12.8" />
        <path d="M10.6 9a9 9 0 0 1 4.4 4.4" />
      </svg>
    </a>
    <form class="offcanvas offcanvas-start offcanvas-narrow" tabindex="-1" id="offcanvasSettings">
      <div class="offcanvas-header">
        <h2 class="offcanvas-title">Theme Settings</h2>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body d-flex flex-column">
        <div>
          <div class="mb-4">
            <label class="form-label">Color mode</label>
            <p class="form-hint">Choose the color mode for your app.</p>
            <label class="form-check">
              <div class="form-selectgroup-item">
                <input type="radio" name="theme" value="light" class="form-check-input" checked />
                <div class="form-check-label">Light</div>
              </div>
            </label>
            <label class="form-check">
              <div class="form-selectgroup-item">
                <input type="radio" name="theme" value="dark" class="form-check-input" />
                <div class="form-check-label">Dark</div>
              </div>
            </label>
          </div>
          <div class="mb-4">
            <label class="form-label">Color scheme</label>
            <p class="form-hint">The perfect color mode for your app.</p>
            <div class="row g-2">
              <div class="col-auto">
                <label class="form-colorinput">
                  <input name="theme-primary" type="radio" value="blue" class="form-colorinput-input" />
                  <span class="form-colorinput-color bg-blue"></span>
                </label>
              </div>
              <div class="col-auto">
                <label class="form-colorinput">
                  <input name="theme-primary" type="radio" value="azure" class="form-colorinput-input" />
                  <span class="form-colorinput-color bg-azure"></span>
                </label>
              </div>
              <div class="col-auto">
                <label class="form-colorinput">
                  <input name="theme-primary" type="radio" value="indigo" class="form-colorinput-input" />
                  <span class="form-colorinput-color bg-indigo"></span>
                </label>
              </div>
              <div class="col-auto">
                <label class="form-colorinput">
                  <input name="theme-primary" type="radio" value="purple" class="form-colorinput-input" />
                  <span class="form-colorinput-color bg-purple"></span>
                </label>
              </div>
              <div class="col-auto">
                <label class="form-colorinput">
                  <input name="theme-primary" type="radio" value="pink" class="form-colorinput-input" />
                  <span class="form-colorinput-color bg-pink"></span>
                </label>
              </div>
              <div class="col-auto">
                <label class="form-colorinput">
                  <input name="theme-primary" type="radio" value="red" class="form-colorinput-input" />
                  <span class="form-colorinput-color bg-red"></span>
                </label>
              </div>
              <div class="col-auto">
                <label class="form-colorinput">
                  <input name="theme-primary" type="radio" value="orange" class="form-colorinput-input" />
                  <span class="form-colorinput-color bg-orange"></span>
                </label>
              </div>
              <div class="col-auto">
                <label class="form-colorinput">
                  <input name="theme-primary" type="radio" value="yellow" class="form-colorinput-input" />
                  <span class="form-colorinput-color bg-yellow"></span>
                </label>
              </div>
              <div class="col-auto">
                <label class="form-colorinput">
                  <input name="theme-primary" type="radio" value="lime" class="form-colorinput-input" />
                  <span class="form-colorinput-color bg-lime"></span>
                </label>
              </div>
              <div class="col-auto">
                <label class="form-colorinput">
                  <input name="theme-primary" type="radio" value="green" class="form-colorinput-input" />
                  <span class="form-colorinput-color bg-green"></span>
                </label>
              </div>
              <div class="col-auto">
                <label class="form-colorinput">
                  <input name="theme-primary" type="radio" value="teal" class="form-colorinput-input" />
                  <span class="form-colorinput-color bg-teal"></span>
                </label>
              </div>
              <div class="col-auto">
                <label class="form-colorinput">
                  <input name="theme-primary" type="radio" value="cyan" class="form-colorinput-input" />
                  <span class="form-colorinput-color bg-cyan"></span>
                </label>
              </div>
            </div>
          </div>
          <div class="mb-4">
            <label class="form-label">Font family</label>
            <p class="form-hint">Choose the font family that fits your app.</p>
            <div>
              <label class="form-check">
                <div class="form-selectgroup-item">
                  <input type="radio" name="theme-font" value="sans-serif" class="form-check-input" checked />
                  <div class="form-check-label">Sans-serif</div>
                </div>
              </label>
              <label class="form-check">
                <div class="form-selectgroup-item">
                  <input type="radio" name="theme-font" value="serif" class="form-check-input" />
                  <div class="form-check-label">Serif</div>
                </div>
              </label>
              <label class="form-check">
                <div class="form-selectgroup-item">
                  <input type="radio" name="theme-font" value="monospace" class="form-check-input" />
                  <div class="form-check-label">Monospace</div>
                </div>
              </label>
              <label class="form-check">
                <div class="form-selectgroup-item">
                  <input type="radio" name="theme-font" value="comic" class="form-check-input" />
                  <div class="form-check-label">Comic</div>
                </div>
              </label>
            </div>
          </div>
          <div class="mb-4">
            <label class="form-label">Theme base</label>
            <p class="form-hint">Choose the gray shade for your app.</p>
            <div>
              <label class="form-check">
                <div class="form-selectgroup-item">
                  <input type="radio" name="theme-base" value="slate" class="form-check-input" />
                  <div class="form-check-label">Slate</div>
                </div>
              </label>
              <label class="form-check">
                <div class="form-selectgroup-item">
                  <input type="radio" name="theme-base" value="gray" class="form-check-input" checked />
                  <div class="form-check-label">Gray</div>
                </div>
              </label>
              <label class="form-check">
                <div class="form-selectgroup-item">
                  <input type="radio" name="theme-base" value="zinc" class="form-check-input" />
                  <div class="form-check-label">Zinc</div>
                </div>
              </label>
              <label class="form-check">
                <div class="form-selectgroup-item">
                  <input type="radio" name="theme-base" value="neutral" class="form-check-input" />
                  <div class="form-check-label">Neutral</div>
                </div>
              </label>
              <label class="form-check">
                <div class="form-selectgroup-item">
                  <input type="radio" name="theme-base" value="stone" class="form-check-input" />
                  <div class="form-check-label">Stone</div>
                </div>
              </label>
            </div>
          </div>
          <div class="mb-4">
            <label class="form-label">Corner Radius</label>
            <p class="form-hint">Choose the border radius factor for your app.</p>
            <div>
              <label class="form-check">
                <div class="form-selectgroup-item">
                  <input type="radio" name="theme-radius" value="0" class="form-check-input" />
                  <div class="form-check-label">0</div>
                </div>
              </label>
              <label class="form-check">
                <div class="form-selectgroup-item">
                  <input type="radio" name="theme-radius" value="0.5" class="form-check-input" />
                  <div class="form-check-label">0.5</div>
                </div>
              </label>
              <label class="form-check">
                <div class="form-selectgroup-item">
                  <input type="radio" name="theme-radius" value="1" class="form-check-input" checked />
                  <div class="form-check-label">1</div>
                </div>
              </label>
              <label class="form-check">
                <div class="form-selectgroup-item">
                  <input type="radio" name="theme-radius" value="1.5" class="form-check-input" />
                  <div class="form-check-label">1.5</div>
                </div>
              </label>
              <label class="form-check">
                <div class="form-selectgroup-item">
                  <input type="radio" name="theme-radius" value="2" class="form-check-input" />
                  <div class="form-check-label">2</div>
                </div>
              </label>
            </div>
          </div>
        </div>
        <div class="mt-auto space-y">
          <button type="button" class="btn w-100" id="reset-changes">
            <!-- Download SVG icon from http://tabler.io/icons/icon/rotate -->
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
              stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
              class="icon icon-1">
              <path d="M19.95 11a8 8 0 1 0 -.5 4m.5 5v-5h-5" />
            </svg>
            Reset changes
          </button>
          <a href="#" class="btn btn-primary w-100" data-bs-dismiss="offcanvas"> Save </a>
        </div>
      </div>
    </form>
  </div>

  {{-- BEGIN PAGE SCRIPTS --}}
  <script>
    document.addEventListener("DOMContentLoaded", function() {
      var themeConfig = {
        theme: "light",
        "theme-base": "gray",
        "theme-font": "sans-serif",
        "theme-primary": "blue",
        "theme-radius": "1",
      };
      var url = new URL(window.location);
      var form = document.getElementById("offcanvasSettings");
      var resetButton = document.getElementById("reset-changes");
      var checkItems = function() {
        for (var key in themeConfig) {
          var value = window.localStorage["tabler/tabler-" + key] || themeConfig[key];
          if (!!value) {
            var radios = form.querySelectorAll(`[name="${key}"]`);
            if (!!radios) {
              radios.forEach((radio) => {
                radio.checked = radio.value === value;
              });
            }
          }
        }
      };
      form.addEventListener("change", function(event) {
        var target = event.target,
          name = target.name,
          value = target.value;
        for (var key in themeConfig) {
          if (name === key) {
            document.documentElement.setAttribute("data-bs-" + key, value);
            window.localStorage.setItem("tabler/tabler-" + key, value);
            url.searchParams.set(key, value);
          }
        }
        window.history.pushState({}, "", url);
      });
      resetButton.addEventListener("click", function() {
        for (var key in themeConfig) {
          var value = themeConfig[key];
          document.documentElement.removeAttribute("data-bs-" + key);
          window.localStorage.removeItem("tabler/tabler-" + key);
          url.searchParams.delete(key);
        }
        checkItems();
        window.history.pushState({}, "", url);
      });
      checkItems();
    });
  </script>
@endsection
