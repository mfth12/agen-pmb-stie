@php
  $activePenilaian = Request::is('penilaian*');
@endphp

<li class="nav-item {{ $activePenilaian ? 'menu-open' : '' }}">
  <a href="#" class="nav-link {{ $activePenilaian ? 'active' : '' }}">
    <i class="nav-icon fas fa-star"></i>
    <p>
      Karir
      <i class="fas fa-angle-left right"></i>
    </p>
  </a>
  <ul class="nav nav-treeview">
    <li class="nav-item">
      <a href="{{ route('penilaian.index') }}" class="nav-link {{ $activePenilaian ? 'active' : '' }}">
        <i class="far fa-circle nav-icon"></i>
        <p>Penilaian</p>
      </a>
    </li>
    {{-- <li class="nav-item">
      <a href="{{ route('maintenance') }}" class="nav-link">
        <i class="far fa-circle nav-icon"></i>
        <p>Jabatan</p>
      </a>
    </li>
    <li class="nav-item">
      <a href="{{ route('maintenance') }}" class="nav-link">
        <i class="far fa-circle nav-icon"></i>
        <p>Pangkat</p>
      </a>
    </li> --}}
  </ul>
</li>
