@extends('components.theme.back')

@section('container')
  <div class="content-wrapper">
    <section class="content-header">
      <div class="container">
        <div class="row mb-2">
          <div class="col-sm-6">
          </div>
          <div class="col-sm-6">
          </div>
        </div>
      </div>
    </section>

    <section class="content">
      <div class="error-page mt-5">
        <h3><i class="fas fa-exclamation-triangle text-warning"></i> Oops! Belum tersedia</h3>
        <p>Modul/fitur sedang dalam pengembangan, mohon maaf atas ketidaknyamanannya.</p>
        <form class="search-form mb-4">
          <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Cari sesuatu..">
            <div class="input-group-append">
              <button type="submit" name="submit" class="btn btn-warning"><i class="fas fa-search"></i>
              </button>
            </div>
          </div>
        </form>
        <div class="img-container">
          <img src="{{ asset('img/maintenance.png') }}" class="img-fluid" style="max-width: 100%; height: auto;" alt="">
          {{-- <img src="https://doodleipsum.com/700/outline?i=efb2399e32de73e7933220b64879154a" class="img-fluid" style="max-width: 100%; height: auto;" alt=""> --}}
        </div>
      </div>
    </section>
  </div>
@endsection

@section('style')
  <style>
    .img-container {
      display: flex;
      justify-content: center;
      align-items: center;
    }
  </style>
@endsection
