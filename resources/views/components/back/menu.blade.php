<header class="navbar-expand-md">
  <div class="collapse navbar-collapse" id="navbar-menu">
    <div class="navbar">
      <div class="container-xl">
        <div class="row flex-column flex-md-row flex-fill align-items-center">
          <div class="col">
            {{-- NAVBAR MENU --}}
            <ul class="navbar-nav">
              {{-- DASBOR --}}
              <li class="nav-item {{ request()->routeIs('dashboard.*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('dashboard.index') }}">
                  <span class="nav-link-icon d-md-none d-lg-inline-block">
                    <i class="ti ti-smart-home fs-2"></i>
                  </span>
                  <span class="nav-link-title">Beranda</span>
                </a>
              </li>

              {{-- PENDAFTARAN --}}
              <li
                class="nav-item dropdown {{ request()->routeIs('pengajuan.*') || request()->routeIs('approval.*') ? 'active' : '' }}">
                <a class="nav-link dropdown-toggle" href="#navbar-pendaftaran" data-bs-toggle="dropdown"
                  data-bs-auto-close="outside" role="button" aria-expanded="false">
                  <span class="nav-link-icon d-md-none d-lg-inline-block">
                    <i class="ti ti-book-2 fs-2"></i>
                  </span>
                  <span class="nav-link-title">Pendaftaran</span>
                </a>
                <div class="dropdown-menu">
                  <div class="dropdown-menu-columns">
                    <div class="dropdown-menu-column">
                      {{-- Menu Pengajuan --}}
                      @can('pengajuan_view')
                        <a class="dropdown-item {{ request()->routeIs('pengajuan.*') ? 'active' : '' }}"
                          href="{{ route('pengajuan.index') }}">
                          Data Pengajuan
                        </a>
                      @endcan

                      {{-- Menu Approval --}}
                      @can('approval_view')
                        <a class="dropdown-item {{ request()->routeIs('approval.*') ? 'active' : '' }}"
                          href="{{ route('approval.index') }}">
                          Approval Mahasiswa
                        </a>
                      @endcan

                      {{-- Menu Keuangan --}}
                      @can('keuangan_view')
                        <a class="dropdown-item {{ request()->routeIs('keuangan.*') ? 'active' : '' }}"
                          href="{{ route('keuangan.index') }}">
                          Verifikasi Keuangan
                        </a>
                      @endcan
                    </div>
                  </div>
                </div>
              </li>

              {{-- PENGATURAN --}}
              <li
                class="nav-item dropdown {{ request()->routeIs('pengguna.*') || request()->routeIs('konfigurasi.*') ? 'active' : '' }}">
                <a class="nav-link dropdown-toggle" href="#navbar-pengaturan" data-bs-toggle="dropdown"
                  data-bs-auto-close="outside" role="button" aria-expanded="false">
                  <span class="nav-link-icon d-md-none d-lg-inline-block">
                    <i class="ti ti-adjustments fs-2"></i>
                  </span>
                  <span class="nav-link-title">Pengaturan</span>
                </a>
                <div class="dropdown-menu">
                  <div class="dropdown-menu-columns">
                    <div class="dropdown-menu-column">
                      {{-- Menu Manajemen Pengguna --}}
                      @can('user_view')
                        <a class="dropdown-item {{ request()->routeIs('pengguna.*') ? 'active' : '' }}"
                          href="{{ route('pengguna.index') }}">
                          Manajemen Pengguna
                        </a>
                      @endcan

                      {{-- Menu Konfigurasi Sistem --}}
                      @can('system_manage') {{-- Asumsikan ada permission system_manage --}}
                        <a class="dropdown-item {{ request()->routeIs('konfigurasi.*') ? 'active' : '' }}"
                          href="{{ route('konfigurasi.index') }}">
                          Konfigurasi Sistem
                        </a>
                      @endcan

                      {{-- Menu Roles & Permissions --}}
                      @can('role_view') {{-- Asumsikan ada permission role_view --}}
                        <a class="dropdown-item {{ request()->routeIs('roles.*') ? 'active' : '' }}"
                          href="{{ route('roles.index') }}">
                          Roles & Permissions
                        </a>
                      @endcan
                    </div>
                  </div>
                </div>
              </li>

              {{-- LAPORAN --}}
              @can('report_view')
                {{-- Asumsikan ada permission report_view --}}
                <li class="nav-item {{ request()->routeIs('laporan.*') ? 'active' : '' }}">
                  <a class="nav-link" href="{{ route('laporan.index') }}">
                    <span class="nav-link-icon d-md-none d-lg-inline-block">
                      <i class="ti ti-chart-bar fs-2"></i>
                    </span>
                    <span class="nav-link-title">Laporan</span>
                  </a>
                </li>
              @endcan
            </ul>
            {{-- AKHIR NAVBAR MENU --}}
          </div>

          <div class="col col-md-auto">
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link" href="#" data-bs-toggle="offcanvas" data-bs-target="#offcanvasSettings">
                  <span class="nav-link-icon d-md-none d-lg-inline-block">
                    <i class="ti ti-palette fs-2"></i>
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
