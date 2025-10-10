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
                          <a href="./sign-in-cover.html" class="dropdown-item"> Sign in with cover </a>
                          <a href="./sign-up.html" class="dropdown-item"> Sign up </a>
                          <a href="./forgot-password.html" class="dropdown-item"> Forgot password </a>
                          <a href="./terms-of-service.html" class="dropdown-item"> Terms of service </a>
                          <a href="./auth-lock.html" class="dropdown-item"> Lock screen </a>
                          <a href="./2-step-verification.html" class="dropdown-item"> 2 step verification </a>
                          <a href="./2-step-verification-code.html" class="dropdown-item"> 2 step verification
                            code </a>
                        </div>
                      </div>
                      <a class="dropdown-item" href="./avatars.html">
                        Avatars
                        <span class="badge badge-sm bg-green-lt text-uppercase ms-auto">Baru</span>
                      </a>
                      <a class="dropdown-item" href="./badges.html"> Badges </a>
                      <a class="dropdown-item" href="./blank.html"> Blank page </a>
                      <a class="dropdown-item" href="./buttons.html"> Buttons </a>
                      <div class="dropend">
                        <a class="dropdown-item dropdown-toggle" href="#sidebar-cards" data-bs-toggle="dropdown"
                          data-bs-auto-close="outside" role="button" aria-expanded="false">
                          Cards
                        </a>
                        <div class="dropdown-menu">
                          <a href="./cards.html" class="dropdown-item"> Sample cards </a>
                          <a href="./card-actions.html" class="dropdown-item">
                            Card actions
                            <span class="badge badge-sm bg-green-lt text-uppercase ms-auto">Baru</span>
                          </a>
                          <a href="./cards-masonry.html" class="dropdown-item"> Cards Masonry </a>
                        </div>
                      </div>
                      <a class="dropdown-item" href="./carousel.html"> Carousel </a>
                      <a class="dropdown-item" href="./colors.html"> Colors </a>
                      <a class="dropdown-item" href="./datagrid.html"> Data grid </a>
                      <a class="dropdown-item" href="./dropdowns.html"> Dropdowns </a>
                      <div class="dropend">
                        <a class="dropdown-item dropdown-toggle" href="#sidebar-error" data-bs-toggle="dropdown"
                          data-bs-auto-close="outside" role="button" aria-expanded="false">
                          Error pages
                        </a>
                        <div class="dropdown-menu">
                          <a href="./error-404.html" class="dropdown-item"> 404 page </a>
                          <a href="./error-500.html" class="dropdown-item"> 500 page </a>
                          <a href="./error-maintenance.html" class="dropdown-item"> Maintenance page </a>
                        </div>
                      </div>
                      <a class="dropdown-item" href="./lists.html"> Lists </a>
                      <a class="dropdown-item" href="./modals.html"> Modals </a>
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
                        Agen Sekolah
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
