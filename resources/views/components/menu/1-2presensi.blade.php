@php
  $activePresensi = Request::is('presensi*');
  $activeJadwal = Request::is('jadwal*');
  $activePerizinan = Request::is('perizinan*');
  $activePercutian = Request::is('percutian*');
  $activeDinas = Request::is('perdinasan*');
@endphp

<li
  class="nav-item {{ $activePresensi || $activeJadwal || $activePerizinan || $activePercutian || $activeDinas ? 'menu-open' : '' }}">
  <a href="#"
    class="nav-link {{ $activePresensi || $activeJadwal || $activePerizinan || $activePercutian || $activeDinas ? 'active' : '' }}">
    <i class="nav-icon fas fa-chart-simple"></i>
    <p>
      Kehadiran
      <i class="fas fa-angle-left right"></i>
    </p>
  </a>
  <ul class="nav nav-treeview">
    <li class="nav-item">
      @canany(['akses_superadmin', 'akses_manager'])
        {{-- SUPERADMIN MANAGER --}}
        <a href="{{ route('presensi.index') }}" class="nav-link {{ $activePresensi || $activeJadwal ? 'active' : '' }}">
          <i class="far fa-circle nav-icon"></i>
          <p>Presensi</p>
        </a>
      @else
        {{-- SELAIN ITU SEMUA --}}
        <a href="{{ route('presensi.pribadi') }}" class="nav-link {{ $activePresensi ? 'active' : '' }}">
          <i class="far fa-circle nav-icon"></i>
          <p>Presensi</p>
        </a>
      @endcanany
    </li>

    <li class="nav-item">
      <a href="{{ route('perizinan.index') }}" class="nav-link {{ $activePerizinan ? 'active' : '' }}">
        <i class="far fa-circle nav-icon"></i>
        <p>Perizinan</p>
      </a>
    </li>
    <li class="nav-item">
      <a href="{{ route('percutian.index') }}" class="nav-link {{ $activePercutian ? 'active' : '' }}">
        <i class="far fa-circle nav-icon"></i>
        <p>Cuti</p>
      </a>
    </li>
    <li class="nav-item">
      <a href="{{ route('perdinasan.index') }}" class="nav-link {{ $activeDinas ? 'active' : '' }}">
        <i class="far fa-circle nav-icon"></i>
        <p>Dinas</p>
      </a>
    </li>
  </ul>
</li>
