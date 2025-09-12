@php
  $activeGaji = Request::is('gaji');
  $activeGajiPokok = Request::is('gaji_pokok*');
  $activeTunjangan = Request::is('tunjangan*');
  $activePotongan = Request::is('potongan*');
  $activeMaintenance = Request::is('maintenance*');
@endphp

{{-- <li class="nav-item {{ $activeGaji || $activeTunjangan || $activePotongan || $activeGajiPokok ? 'menu-open' : '' }}">
  <a href="#"
    class="nav-link {{ $activeGaji || $activeTunjangan || $activePotongan || $activeGajiPokok ? 'active' : '' }}">
    <i class="nav-icon fas fa-wallet"></i>
    <p>
      Payroll
      <i class="fas fa-angle-left right"></i>
    </p>
  </a>
  @canany(['akses_superadmin', 'akses_manager'])
    <ul class="nav nav-treeview">
      <li class="nav-item">
        <a href="{{ route('gaji.index') }}" class="nav-link {{ $activeGaji ? 'active' : '' }}">
          <i class="far fa-circle nav-icon"></i>
          <p>Gaji</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('gaji_pokok.index') }}" class="nav-link {{ $activeGajiPokok ? 'active' : '' }}">
          <i class="far fa-circle nav-icon"></i>
          <p>Pokok</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('tunjangan.index') }}" class="nav-link {{ $activeTunjangan ? 'active' : '' }}">
          <i class="far fa-circle nav-icon"></i>
          <p>Tunjangan</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('potongan.index') }}" class="nav-link {{ $activePotongan ? 'active' : '' }}">
          <i class="far fa-circle nav-icon"></i>
          <p>Potongan</p>
        </a>
      </li>
    </ul>
  @else
    <ul class="nav nav-treeview">
      <li class="nav-item">
        <a href="{{ route('maintenance') }}" class="nav-link {{ $activeGaji ? 'active' : '' }}">
          <i class="far fa-circle nav-icon"></i>
          <p>Gaji</p>
        </a>
      </li>
    </ul>
  @endcanany
</li> --}}

<li class="nav-item">
  @canany(['akses_superadmin', 'akses_manager'])
    <a href="{{ route('gaji.index') }}"
      class="nav-link {{ $activeGaji || $activeTunjangan || $activePotongan || $activeGajiPokok ? 'active' : '' }}">
    @else
      <a href="{{ route('maintenance') }}" class="nav-link {{ $activeMaintenance ? 'active' : '' }}">
      @endcanany
      <i class="nav-icon fas fa-wallet"></i>
      <p>Payroll / Gaji</p>
    </a>
</li>
