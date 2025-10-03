@extends('components.theme.error')
@section('title', 'Eror 404 (Tidak Ditemukan)')

@section('container')
  <div class="empty-img">
    @include('components.error.illustrations-not-found')
  </div>
  <p class="empty-title">Eror 404 (Tidak Ditemukan)</p>
  <p class="empty-subtitle text-secondary">Uups! Permintaan Anda tidak dapat ditemukan</p>
@endsection
