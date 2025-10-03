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
                  <span class="nav-link-title"> Beranda </span>
                </a>
              </li>
              {{-- SISTEM --}}
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown"
                  data-bs-auto-close="outside" role="button" aria-expanded="false">
                  <span class="nav-link-icon d-md-none d-lg-inline-block">
                    <i class="ti ti-book-2 fs-2"></i></span>
                  <span class="nav-link-title">Non-Akademik</span>
                </a>
                <div class="dropdown-menu">
                  <div class="dropdown-menu-columns">
                    <div class="dropdown-menu-column">
                      <a class="dropdown-item" href="./accordion.html">
                        Accordion
                        <span class="badge badge-sm bg-green-lt text-uppercase ms-auto">New</span>
                      </a>
                      <a class="dropdown-item" href="./alerts.html"> Alerts </a>
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
                        <span class="badge badge-sm bg-green-lt text-uppercase ms-auto">New</span>
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
                            <span class="badge badge-sm bg-green-lt text-uppercase ms-auto">New</span>
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
                    <div class="dropdown-menu-column">
                      <a class="dropdown-item" href="./markdown.html"> Markdown </a>
                      <a class="dropdown-item" href="./navigation.html"> Navigation </a>
                      <a class="dropdown-item" href="./offcanvas.html"> Offcanvas </a>
                      <a class="dropdown-item" href="./pagination.html"> Pagination </a>
                      <a class="dropdown-item" href="./placeholder.html"> Placeholder </a>
                      <a class="dropdown-item" href="./segmented-control.html">
                        Segmented control
                        <span class="badge badge-sm bg-green-lt text-uppercase ms-auto">New</span>
                      </a>
                      <a class="dropdown-item" href="./scroll-spy.html">
                        Scroll spy
                        <span class="badge badge-sm bg-green-lt text-uppercase ms-auto">New</span>
                      </a>
                      <a class="dropdown-item" href="./social-icons.html"> Social icons </a>
                      <a class="dropdown-item" href="./stars-rating.html"> Stars rating </a>
                      <a class="dropdown-item" href="./steps.html"> Steps </a>
                      <a class="dropdown-item" href="./tables.html"> Tables </a>
                      <a class="dropdown-item" href="./tabs.html"> Tabs </a>
                      <a class="dropdown-item" href="./tags.html"> Tags </a>
                      <a class="dropdown-item" href="./toasts.html"> Toasts </a>
                      <a class="dropdown-item" href="./typography.html"> Typography </a>
                    </div>
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
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                      fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                      stroke-linejoin="round" class="icon icon-1">
                      <path
                        d="M10.325 4.317c.426 -1.756 2.924 -1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543 -.94 3.31 .826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756 .426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543 -.826 3.31 -2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756 -2.924 1.756 -3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543 .94 -3.31 -.826 -2.37 -2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756 -.426 -1.756 -2.924 0 -3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94 -1.543 .826 -3.31 2.37 -2.37c1 .608 2.296 .07 2.572 -1.065z" />
                      <path d="M9 12a3 3 0 1 0 6 0a3 3 0 0 0 -6 0" />
                    </svg>
                  </span>
                  <span class="nav-link-title">Atur Tampilan</span>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</header>
