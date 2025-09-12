@php
  use Illuminate\Support\Str;
  $namaUser = auth()->user()->nama;
  $namaPendek = Str::limit($namaUser, 25, '..');
@endphp
{{-- Navbar --}}
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
  {{-- Left navbar links --}}
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" id="menu_klik" data-widget="pushmenu" href="javascript:void(0)" role="button"><i
          class="fas fa-bars"></i></a>
    </li>
  </ul>

  {{-- Right navbar links --}}
  <ul class="navbar-nav ml-auto">
    {{-- Option Menu --}}
    <li class="nav-item dropdown">
      <a class="nav-link" data-toggle="dropdown" href="javascript:void(0)" data-placement="bottom" title="Opsi">
        {{ auth()->user()->detail->panggilan ?? $namaPendek }}
        <i class="far fa-circle-user fa-lg ml-1"></i>
      </a>
      <div class="dropdown-menu dropdown-menu-md dropdown-menu-right" style="min-width: 220px">
        <div class="card-widget widget-user">
          <!-- Add the bg color to the header using any of the bg-* classes -->
          <div class="widget-user-header text-white"
            style="background: url('/img/background-stie.jpg') center center; margin: -10px 0 0 0; filter: blur(0.1px); height: 5rem">
          </div>
          <div class="widget-user-image" style="top: 2rem; margin-left: -2.2rem">
            <img class="img-circle" style="border: 3.5px solid #fff; width: 4.5rem"
              src="/storage/{{ auth()->user()->detail->foto }}" alt="{{ auth()->user()->detail->panggilan ?? '' }}">
          </div>
          <a href="{{ route('profil') }}" class="dropdown-item mt-4">
            <i class="fa fa-user mr-2"></i>
            {{ $namaPendek }}
          </a>
          <a href="/kotaksaran" class="dropdown-item">
            <i class="fas fa-inbox mr-2"></i>
            Aduan & Saran
          </a>
          <a href="/panduan" target="_blank" class="dropdown-item">
            <i class="fas fa-book mr-2"></i>
            Panduan
          </a>

          <div class="dropdown-divider"></div>

          <a href="javascript:void(0)" data-widget="fullscreen" class="dropdown-item">
            <i class="fa-solid fa-expand-arrows-alt mr-2"></i> Layar Penuh
          </a>
          {{-- AKSES::SUPERADMIN DAN MANAGER --}}
          @can('akses_superadmin_manager')
            <a href="/konfig" class="dropdown-item">
              <i class="fas fa-gear mr-2"></i>
              Konfigurasi
            </a>
          @endcan
          <a href="javascript:void(0)" onclick="keluarConfirm('/keluar')" class="dropdown-item">
            <i class="fa-solid fa-arrow-right-from-bracket mr-2"></i> Keluar
          </a>
        </div>
      </div>
    </li>

    {{-- Notifications Menu --}}
    <li class="nav-item dropdown">
      <a class="nav-link" style="padding-left: 1px" data-toggle="dropdown" href="javascript:void(0)"
        data-placement="bottom" title="Notifikasi">
        <i class="far fa-bell fa-lg"></i>
        <span class="badge badge-success navbar-badge"><b>7</b></span>
      </a>
      <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        <span class="dropdown-header">7 Notifikasi</span>
        <div class="dropdown-divider"></div>
        <a href="javascript:void(0)" class="dropdown-item" onclick="dev()">
          <i class="fas fa-envelope mr-2"></i> 2 Pesan baru
          <span class="float-right text-muted text-sm">3 menit lalu</span>
        </a>
        <div class="dropdown-divider"></div>
        <a href="javascript:void(0)" class="dropdown-item" onclick="dev()">
          <i class="fas fa-user-group mr-2"></i> 1 Pengajuan cuti
          <span class="float-right text-muted text-sm">12 jam lalu</span>
        </a>
        <div class="dropdown-divider"></div>
        <a href="javascript:void(0)" class="dropdown-item" onclick="dev()">
          <i class="fas fa-file mr-2"></i> 4 Pengajuan izin
          <span class="float-right text-muted text-sm">2 hari lalu</span>
        </a>
        <div class="dropdown-divider"></div>
        <a href="javascript:void(0)" class="dropdown-item dropdown-footer" onclick="dev()">Lihat semua notifikasi</a>
      </div>
    </li>
  </ul>
</nav>
{{-- Akhir Navbar --}}
