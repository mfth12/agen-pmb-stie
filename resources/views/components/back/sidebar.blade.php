<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <a href="/" class="brand-link">
    @if ($konfigs->logo_lembaga)
      <img src="{{ asset('img/' . $konfigs->logo_lembaga) }}" class="brand-image img-circle elevation-3">
    @endif
    <span class="brand-text font-weight-light {{ $konfigs->logo_lembaga ? '' : 'ml-3' }}">
      {{ $konfigs->nama_sistem }}
    </span>
  </a>

  <div class="sidebar">
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <x-menu.0-0carimenu />
        <x-menu.0-0profil />

        {{-- --------------------------------------------------------------- --}}
        {{-- MENU SUPERADMIN MENU SUPERADMIN MENU SUPERADMIN MENU SUPERADMIN --}}
        {{-- MENU SUPERADMIN MENU SUPERADMIN MENU SUPERADMIN MENU SUPERADMIN --}}
        {{-- --------------------------------------------------------------- --}}
        @can('akses_superadmin')
          <li style="padding: 1rem 1rem .5rem" class="nav-header">UTAMA</li>
          <x-menu.1-1dasbor />
          <x-menu.1-2presensi />
          <x-menu.1-3karir />
          {{-- <x-menu.1-4dokumen /> --}}
          <x-menu.1-5pendapatan />
          <li class="nav-header">EKSTRA</li>
          <x-menu.2-1pengguna />
          <x-menu.2-4unitkerja />
          {{-- <x-menu.2-2berita /> --}}
          <x-menu.3-3kotaksaran />
          <x-menu.3-2konfig />
          {{-- <li class="nav-header">PERSONAL</li> --}}
          {{-- <x-menu.3-1profil /> --}}
          {{-- <x-menu.3-4panduan /> --}}
        @endcan



        {{-- ---------------------------------------------------------------- --}}
        {{-- MENU MANAGER MENU MANAGER MENU MANAGER MENU MANAGER MENU MANAGER --}}
        {{-- MENU MANAGER MENU MANAGER MENU MANAGER MENU MANAGER MENU MANAGER --}}
        {{-- ---------------------------------------------------------------- --}}
        @can('akses_manager')
          <li style="padding: 1.5rem 1rem .5rem" class="nav-header">UTAMA</li>
          <x-menu.1-1dasbor />
          <x-menu.1-2presensi />
          <x-menu.1-3karir />
          {{-- <x-menu.1-4dokumen /> --}}
          <x-menu.1-5pendapatan />
          <li class="nav-header">EKSTRA</li>
          <x-menu.2-1pengguna />
          <x-menu.2-4unitkerja />
          <x-menu.3-3kotaksaran />
          <x-menu.3-2konfig />
          {{-- <li class="nav-header">PERSONAL</li>  --}}
          {{-- <x-menu.3-1profil /> --}}
          {{-- <x-menu.3-4panduan /> --}}
        @endcan



        {{-- ----------------------------------------------------------- --}}
        {{-- MENU ATASAN MENU ATASAN MENU ATASAN MENU ATASAN MENU ATASAN --}}
        {{-- MENU ATASAN MENU ATASAN MENU ATASAN MENU ATASAN MENU ATASAN --}}
        {{-- ----------------------------------------------------------- --}}
        @can('akses_atasan')
          <li style="padding: 1.5rem 1rem .5rem" class="nav-header">UTAMA</li>
          <x-menu.1-1dasbor />
          <x-menu.1-2presensi />
          <x-menu.1-3karir />
          {{-- <x-menu.1-4dokumen /> --}}
          <x-menu.1-5pendapatan />
          <li class="nav-header">EKSTRA</li>
          <x-menu.3-3kotaksaran />
          {{-- <li class="nav-header">PERSONAL</li>  --}}
          {{-- <x-menu.3-1profil /> --}}
          {{-- <x-menu.3-4panduan /> --}}
        @endcan



        {{-- ---------------------------------------------------------------- --}}
        {{-- MENU PEGAWAI MENU PEGAWAI MENU PEGAWAI MENU PEGAWAI MENU PEGAWAI --}}
        {{-- MENU PEGAWAI MENU PEGAWAI MENU PEGAWAI MENU PEGAWAI MENU PEGAWAI --}}
        {{-- ---------------------------------------------------------------- --}}
        @can('akses_pegawai')
          <li style="padding: 1.5rem 1rem .5rem" class="nav-header">UTAMA</li>
          <x-menu.1-1dasbor />
          <x-menu.1-2presensi />
          <x-menu.1-3karir />
          {{-- <x-menu.1-4dokumen /> --}}
          <x-menu.1-5pendapatan />
          <li class="nav-header">EKSTRA</li>
          <x-menu.3-3kotaksaran />
          {{-- <li class="nav-header">PERSONAL</li>  --}}
          {{-- <x-menu.3-1profil /> --}}
          {{-- <x-menu.3-4panduan /> --}}
        @endcan
        {{-- END --}}
        <li class="nav-item mb-5">
          <p></p>
          <p></p>
        </li>
      </ul>
    </nav>
  </div>
</aside>
