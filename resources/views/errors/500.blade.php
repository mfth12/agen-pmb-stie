@extends('components.theme.error')
@section('title', 'Eror 500 (Kesalahan Internal Server)')

@section('container')
  <div class="empty-img">
    @include('components.error.illustrations-computer-fix')
  </div>
  <p class="empty-title">Eror 500 (Kesalahan Internal Server)</p>
  <p class="empty-subtitle text-secondary">Uups! Terjadi masalah internal pada sistem atau server</p>
@endsection
