@extends('components.theme.back')

@section('container')
  <div class="content-wrapper">
    <section class="content-header">
      <div class="container">
        <div class="row mb-2">
          <div class="col-lg-6">
            <h1>{{ $head_page }}</h1>
          </div>

          <div class="col-lg-6">
            <ol class="breadcrumb float-sm-right">
              {{ Breadcrumbs::render() }}
            </ol>
          </div>
        </div>
      </div>
    </section>

    {{-- Main content --}}
    <section class="content">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="callout callout-default">
              Catatan pengiriman pesan whatsapp dari {{ konfigs('NAMA_SISTEM') . ' ' . $konfigs->nama_lembaga }}
            </div>
          </div>
          <div class="col-lg-12">
            <div class="card">
              <div class="card-body">
                {{-- Tombol Atas --}}
                <div class="d-flex flex-wrap justify-content-between">
                  <div class="d-flex flex-wrap justify-content-lg-start">
                    <div class="form-group mr-2">
                      @if (request()->routeIs('presensi.whatsapp'))
                        <a href="{{ route('presensi.index') }}" class="btn btn-default">
                          <i class="fas fa-chevron-left mr-1"></i>Kembali
                        </a>
                      @endif
                    </div>

                    {{-- Dropdown Bulan --}}
                    <div class="form-group mr-2">
                      <select class="form-control select2" id="bulan-filter" style="width: 100%;">
                        <option value="">Semua Bulan</option>
                        <option value="1">Januari</option>
                        <option value="2">Februari</option>
                        <option value="3">Maret</option>
                        <option value="4">April</option>
                        <option value="5">Mei</option>
                        <option value="6">Juni</option>
                        <option value="7">Juli</option>
                        <option value="8">Agustus</option>
                        <option value="9">September</option>
                        <option value="10">Oktober</option>
                        <option value="11">November</option>
                        <option value="12">Desember</option>
                      </select>
                    </div>

                    {{-- Dropdown Periode --}}
                    <div class="form-group mr-2">
                      <select class="form-control select2" id="periode-filter" style="width: 100%;">
                        <option value="">Semua Periode</option>
                        @foreach ($periode as $periode)
                          <option value="{{ $periode->id_periode }}">{{ $periode->periode }}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                </div>
                <table id="tabel_antrian_wa" class="table table-hover">
                  <thead>
                    <tr>
                      <th class="text-center" style="width: 1px;">No.</th>
                      <th class="text-center">Foto</th>
                      <th class="text-center" style="max-width: 23%;">Nama</th>
                      <th class="text-center" style="max-width: 8%;">Target</th>
                      <th class="text-center" style="max-width: 8%;">Tipe</th>
                      <th class="text-center" style="max-width: 25%;">Pesan</th>
                      <th class="text-center" style="max-width: 8%;">Antrian</th>
                      <th class="text-center" style="max-width: 1%;">Status</th>
                    </tr>
                  </thead>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection

@section('js_atas')
  <link rel="stylesheet" href="{{ asset('css/back/select2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css/back/select2-bootstrap4.min.css') }}">
@endsection

@section('style')
  <style>
    /* masih kosong */
    .table-avatar img,
    img.table-avatar {
      border-radius: 50%;
      display: inline;
      width: 1.8rem;
    }

    .badge-outline-primary {
      text-align: center;
      margin: 0;
      color: green;
      background-color: transparent;
      border: 1px solid;
      border-radius: 1rem;
    }

    .badge-outline-secondary {
      text-align: center;
      margin: 0;
      /* color: rgb(117, 117, 117); */
      background-color: transparent;
      border: 1px solid;
      border-radius: 1rem;
    }

    .badge-null {
      text-align: center;
      margin: 0;
      color: rgba(0, 0, 0, 0.25);
      background-color: transparent;
    }
  </style>
@endsection

@section('js_bawah')
  <script src="{{ asset('js/plugins/sparkline.js') }}"></script>
  <script src="{{ asset('js/plugins/chart.js/Chart.min.js') }}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.1/anime.min.js"></script>

  <script src="{{ asset('js/back/jquery.inputmask.min.js') }}"></script>
  <script src="{{ asset('js/back/select2.full.min.js') }}"></script>
  <script type="text/javascript">
    //CSRF TOKEN PADA HEADER
    //Script ini wajib krn kita butuh csrf token setiap kali mengirim request post, patch, put dan delete ke server
    $(document).ready(function() {
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
    });

    //Initialize Select2 Elements
    $('.select2').select2()

    // MULAI DATATABLE
    // script untuk memanggil data json dari server dan menampilkannya berupa datatable
    $(document).ready(function() {
      $('#tabel_antrian_wa').DataTable({
        info: true,
        autoWidth: true, //mengatur lebar width pada table otomatis //set to false
        colReorder: true, // Aktifkan ColReorder untuk tabel
        scrollX: true,
        lengthChange: true, //apakah jumlah row statik atau bisa berubah
        lengthMenu: [
          [25, 50, 100, 150, -1],
          [25, 50, 100, 150, "Semua"]
        ], //jumlah data yang ditampilkan

        processing: true,
        deferRender: true,
        serverSide: true, //aktifkan server-side
        ajax: {
          url: "{{ route('presensi.whatsapp') }}",
          type: 'GET'
        },
        columns: [{
            data: null,
            sortable: false,
            className: "text-center text-nowrap ml-2",
            render: function(data, type, row, meta) {
              return meta.row + meta.settings._iDisplayStart + 1;
            }
          },
          {
            data: 'foto',
            name: 'foto',
            className: "text-center text-nowrap"
          },
          {
            data: 'nama',
            name: 'nama',
            className: "text-left text-nowrap"
          },
          {
            data: 'targetsesi',
            name: 'targetsesi',
            className: "text-center text-nowrap"
          },
          {
            data: 'tipe',
            name: 'tipe',
            className: "text-center text-nowrap"
          },
          {
            data: 'pesan',
            name: 'pesan',
            className: "text-center text-nowrap"
          },
          {
            data: 'dibuat',
            name: 'dibuat',
            className: "text-center text-nowrap"
          },
          {
            data: 'status',
            name: 'status',
            className: "text-center text-nowrap"
          },
        ],
        ordering: false,
        language: {
          "processing": "Memproses data...",
          "loadingRecords": "Masih memproses...",
          "lengthMenu": "Tampil _MENU_ baris data",
          "zeroRecords": "Data tidak ditemukan",
          "info": "Hal. _PAGE_ dari _PAGES_",
          "infoEmpty": " ",
          "infoFiltered": "(filter dari _MAX_ rekam data)",
          "search": "Cari:",
          "emptyTable": "Belum ada data",
          "thousands": ".",
          "paginate": {
            "first": "Pertama",
            "last": "Terakhir",
            "next": "Next",
            "previous": "Prev"
          }
        },
        initComplete: function() {
          console.log('Data presensi selesai digenerate untuk tabel_antrian_wa.');
        }
      });
    });


    // Selesaikan NProgress saat AJAX request selesai dan gambar-gambar dalam tabel telah dimuat
    $(document).ajaxComplete(function(event, xhr, settings) {
      const $container = $('#tabel_antrian_wa'); // Gantilah dengan selector tabel Anda
      stopLoadingWhenImagesLoaded($container);
    });
  </script>
@endsection
