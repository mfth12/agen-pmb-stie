@php
  $activePengguna = Request::is('pengguna*');
  $activeUnitKerja = Request::is('pengguna*');
@endphp

<li class="nav-item">
  <a href="{{ route('pengguna.index') }}" class="nav-link {{ $activePengguna || $activeUnitKerja ? 'active' : '' }}">
    <i class="nav-icon fas fa-user-group"></i>
    <p>
      Pengguna
      <span class="badge badge-light right">
        {{ App\Models\Pengguna::count() }}
      </span>
    </p>
  </a>
</li>
