<header class="navbar-expand-md">
  <div class="collapse navbar-collapse" id="navbar-menu">
    <div class="navbar">
      <div class="container-xl">
        <div class="row flex-column flex-md-row flex-fill align-items-center">
          <div class="col">
            {{-- NAVBAR MENU --}}
            <ul class="navbar-nav">
              {{-- DASBOR --}}
              <li class="nav-item active">
                <a class="nav-link" href="./">
                  <span class="nav-link-icon d-md-none d-lg-inline-block">
                    <i class="ti ti-smart-home fs-2"></i>
                  </span>
                  <span class="nav-link-title">Beranda</span>
                </a>
              </li>
              {{-- SISTEM --}}
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown"
                  data-bs-auto-close="outside" role="button" aria-expanded="false">
                  <span class="nav-link-icon d-md-none d-lg-inline-block">
                    <i class="ti ti-book-2 fs-2"></i></span>
                  <span class="nav-link-title">Pendaftaran</span>
                </a>
                <div class="dropdown-menu">
                  <div class="dropdown-menu-columns">
                    <div class="dropdown-menu-column">
                      <a class="dropdown-item" href="./accordion.html">
                        Accordion
                        <span class="badge badge-sm bg-green-lt text-uppercase ms-auto">Baru</span>
                      </a>
                      <a class="dropdown-item" href="./alerts.html">Alerts</a>
                      <div class="dropend">
                        <a class="dropdown-item dropdown-toggle" href="#sidebar-authentication"
                          data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false">
                          Authentication
                        </a>
                        <div class="dropdown-menu">
                          <a href="./sign-in.html" class="dropdown-item"> Sign in </a>
                          <a href="./sign-in-link.html" class="dropdown-item"> Sign in link </a>
                          <a href="./sign-in-illustration.html" class="dropdown-item"> Sign in with illustration
                          </a>
                          <a href="./forgot-password.html" class="dropdown-item"> Forgot password </a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </li>
              {{-- PENGATURAN --}}
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown"
                  data-bs-auto-close="outside" role="button" aria-expanded="false">
                  <span class="nav-link-icon d-md-none d-lg-inline-block">
                    <i class="ti ti-adjustments fs-2"></i></span>
                  <span class="nav-link-title">Pengaturan</span>
                </a>
                <div class="dropdown-menu">
                  <div class="dropdown-menu-columns">
                    <div class="dropdown-menu-column">
                      <a class="dropdown-item" href="./accordion.html">
                        Manajemen Pengguna
                        <span class="badge badge-sm bg-green-lt text-uppercase ms-auto">Baru</span>
                      </a>
                      <a class="dropdown-item" href="./alerts.html"> Konfigurasi Sistem
                        {{-- <span class="badge badge-sm bg-green-lt text-uppercase ms-auto">Baru</span> --}}
                      </a>
                    </div>
                  </div>
              </li>
            </ul>
            {{-- AKHIR NAVBAR MENU --}}
          </div>
          <div class="col col-md-auto">
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link" href="#" data-bs-toggle="offcanvas" data-bs-target="#offcanvasSettings">
                  <span class="nav-link-icon d-md-none d-lg-inline-block">
                    <i class="ti ti-palette fs-2"></i></span>
                  </span>
                  <span class="nav-link-title">Tampilan</span>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</header>
