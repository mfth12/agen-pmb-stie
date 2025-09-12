@php
  use Illuminate\Support\Str;
  $namaUser = auth()->user()->nama;
  $namaPendek = Str::limit($namaUser, 22, '..');
@endphp
<div class="user-panel mt-2 pb-1 mb-1 d-flex">
  <div class="image">
    <img src="/storage/{{ auth()->user()->detail->foto }}" class="img-circle elevation-2">
  </div>
  <div class="info">
    <a href="{{ route('profil') }}" class="d-block">{{ $namaPendek }}</a>
    <p class="text-sm d-block text-white-50 mb-0">
      <i class="fas fa-star-of-life fa-xs"></i>
      {{-- {{ 'Role: ' . auth()->user()->level->nama_role }} --}}
      {{ 'Akses ' . ucwords(auth()->user()->level->nama_role) }}
    </p>
  </div>
</div>
