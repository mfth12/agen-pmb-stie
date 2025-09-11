@extends('components.theme.back')
@section('container')
  <div class="content-wrapper">
    <section class="content-header">
      <div class="container">
        <div class="row mb-2">
          <div class="col-md-6">
            <h1>{{ $head_page }}</h1>
          </div>
          <div class="col-md-6">
            <ol class="breadcrumb float-sm-right">
              {{ Breadcrumbs::render() }}
            </ol>
          </div>
        </div>
      </div>
    </section>
    <section class="content">
      <div class="container">
        <div class="row align-content-center">
          <div class="col-lg-12">
            <div class="card">
              {{-- komponen header konfig --}}
              <x-back.konfig-head />
              {{-- isi konfig --}}
              @yield('konfig')
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection


@section('style')
  <style>
    /*Code to change color of active link*/
    .nav-pills .nav-link.active,
    .nav-pills .show>.nav-link {
      color: #fff;
      background-color: slategrey;
    }

    .table-borderless td,
    .table-borderless th {
      padding: 0.75rem 0.75rem 0.75rem 0rem;
    }

    .badge-outline-secondary {
      text-align: center;
      color: #6c757d;
      background-color: transparent;
      border-color: #6c757d;
      border: 1px solid;
      border-radius: 1rem;
    }

    .no-select::selection,
    .no-select *::selection {
      background-color: Transparent;
    }

    .no-select {
      /* Sometimes I add this too. */
      cursor: default;
    }

    .frame-gambar {
      color: #6c757d;
      border-color: #6c757d;
      padding: 0.3rem 0.3rem;
      border-radius: 0.25rem;
      border: 1px solid transparent;
    }

    .bundaran_id {
      font-size: 100%;
      padding: 0.1em 0.75em;
      line-height: unset;
      font-weight: 400;
      color: #6c757d;
      background-color: transparent;
      border-color: #6c757d;
      border: 1px solid;
      border-radius: 1rem;
    }
  </style>
@endsection
