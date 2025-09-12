@extends('components.theme.masuk')

@section('container')
  <div class="card card-outline card-secondary">
    <div class="card-header text-center">
      {{-- @php
        dd(konfigs('NAMA_SISTEM'));
      @endphp --}}
      <h2>{{ konfigs('NAMA_SISTEM') }}</h2>
    </div>
  </div>
@endsection
