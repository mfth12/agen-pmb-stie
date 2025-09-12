<div class="card-header p-2">
  <ul class="nav nav-pills flex-nowrap overflow-auto" style="white-space: nowrap;">
    <li class="nav-item"><a class="nav-link {{ Request::is('konfig') ? 'active' : '' }}" href="/konfig">Umum</a></li>
    <li class="nav-item"><a class="nav-link {{ Request::is('konfig/pengguna') ? 'active' : '' }}"
        href="/konfig/pengguna">Pengguna</a></li>
    <li class="nav-item"><a class="nav-link {{ Request::is('konfig/periode') ? 'active' : '' }}"
        href="/konfig/periode">Periode</a></li>
    <li class="nav-item"><a class="nav-link {{ Request::is('konfig/basisdata') ? 'active' : '' }}"
        href="/konfig/basisdata">Basis Data</a></li>
    <li class="nav-item"><a class="nav-link {{ Request::is('konfig/integrasi') ? 'active' : '' }}"
        href="/konfig/integrasi">Integrasi</a></li>
    <li class="nav-item"><a class="nav-link" href="/log-sistem">Log Sistem
        <i class="fas fa-arrow-up-right-from-square fa-sm"></i></a></li>
  </ul>
</div>
