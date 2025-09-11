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
              Data log mesin fingeprint pada {{ $konfigs->nama_sistem . ' ' . $konfigs->nama_lembaga }}
            </div>
          </div>
          {{--  --}}
          <div class="col-lg-12">
            <div class="card">
              <div class="card-body">
                {{-- Tombol Atas --}}
                <div class="d-flex flex-wrap justify-content-lg-start">
                  <div class="form-group mr-2">
                    @if (request()->routeIs('presensi.logs.filter'))
                      <a href="{{ route('presensi.logs') }}" class="btn btn-default">
                        <i class="fas fa-chevron-left mr-1"></i>Kembali
                      </a>
                    @elseif (request()->routeIs('presensi.logs'))
                      <a href="{{ route('presensi.index') }}" class="btn btn-default">
                        <i class="fas fa-chevron-left mr-1"></i>Kembali
                      </a>
                    @endif
                  </div>
                  <div class="form-group mr-2">
                    <div class="input-group">
                      <button type="button" class="btn btn-default" id="daterange-btn" data-toggle="tooltip"
                        data-placement="top" title="Filter Data Tabel">
                        <i class="far fa-calendar-alt mr-2"></i>Tanggal
                        @if (request()->routeIs('presensi.logs.filter'))
                          <strong>{{ $mulaiDate->translatedFormat('d F Y') }}</strong>
                          sampai
                          <strong>{{ $endDate->translatedFormat('d F Y') }}</strong>
                        @endif
                        <span id="selected-date-range"></span>
                        <i class="fas fa-caret-down ml-1"></i>
                      </button>
                    </div>
                  </div>
                </div>

                {{-- tabel --}}
                <table id="table_logsmesin" class="table table-hover">
                  <thead>
                    <tr>
                      <th style="width: 1px;">No.</th>
                      <th style="width: 8%; min-width: 70px;">NPPY</th>
                      <th>Nama</th>
                      <th class="text-center">Tanggal & Waktu</th>
                      <th style="width: 2%; min-width: 70px;">Metode</th>
                      <th>Mesin</th>
                      <th style="width: 3%;">Status</th>
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
  <!-- daterange picker -->
  <link rel="stylesheet" href="{{ asset('css/back/daterangepicker.css') }}">
  <link rel="stylesheet" href="{{ asset('css/back/bootstrap-colorpicker.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css/back/tempusdominus-bootstrap-4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css/back/select2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css/back/select2-bootstrap4.min.css') }}">
@endsection

@section('style')
  <style>
    .no-select::selection,
    .no-select *::selection {
      background-color: Transparent;
    }

    .no-select {
      /* Sometimes I add this too. */
      cursor: default;
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
  </style>
@endsection

@section('js_bawah')
  <!-- date-range-picker -->
  <script src="{{ asset('js/back/jquery.inputmask.min.js') }}"></script>
  <script src="{{ asset('js/back/select2.full.min.js') }}"></script>
  <script src="{{ asset('js/back/moment.min.js') }}"></script>
  <script src="{{ asset('js/back/tempusdominus-bootstrap-4.min.js') }}"></script>
  <script src="{{ asset('js/back/daterangepicker.js') }}"></script>

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

    //MULAI DATATABLE
    //script untuk memanggil data json dari server dan menampilkannya berupa datatable
    $(document).ready(function() {
      @if (request()->routeIs('presensi.logs.filter'))
        var currentUrl = window.location.href;
        // Menggunakan regex untuk mencocokkan pola URL dan mendapatkan nilai start_date dan end_date
        var startDateRegex = /start_date=(\d{4}-\d{2}-\d{2})/;
        var endDateRegex = /end_date=(\d{4}-\d{2}-\d{2})/;
        ////
        var startDateMatches = currentUrl.match(startDateRegex);
        var endDateMatches = currentUrl.match(endDateRegex);
        ///
        // Mendapatkan nilai start_date dan end_date
        var ambilStartDate = startDateMatches ? startDateMatches[1] : null;
        var ambilEndDate = endDateMatches ? endDateMatches[1] : null;
        // Gunakan nilai start_date dan end_date sesuai kebutuhan Anda
      @endif

      $('#table_logsmesin').DataTable({
        info: true,
        // autoWidth: true, //mengatur lebar width pada table otomatis
        colReorder: true, // Aktifkan ColReorder untuk tabel
        scrollX: true,
        lengthChange: true, //apakah jumlah row statik atau bisa berubah
        lengthMenu: [
          [50, 100, 150, -1],
          [50, 100, 150, "Semua"]
        ], //jumlah data yang ditampilkan

        processing: true,
        deferRender: true,
        serverSide: true, //aktifkan server-side
        ajax: {
          // url: "{{ route('presensi.logs') }}",
          @if (request()->routeIs('presensi.logs'))
            url: "{{ route('presensi.logs') }}",
          @elseif (request()->routeIs('presensi.logs.filter'))
            url: "{{ route('presensi.logs.filter') }}",
              data: {
                start_date: ambilStartDate,
                end_date: ambilEndDate
              },
          @endif
          type: 'GET'
        },
        search: {
          "regex": true
        },
        columns: [{
            data: null,
            sortable: true,
            className: "text-center text-nowrap",
            render: function(data, type, row, meta) {
              return meta.row + meta.settings._iDisplayStart + 1;
            }
          },
          {
            data: 'nppy',
            name: 'nppy',
            className: "text-center text-nowrap"
          },
          {
            data: 'nama',
            name: 'nama',
            className: "text-left text-nowrap"
          },
          {
            data: 'tanggalPresensi',
            name: 'tanggalPresensi',
            className: "text-center text-nowrap"
          },
          {
            data: 'metode',
            name: 'metode',
            className: "text-center text-nowrap"
          },
          {
            data: 'ip',
            name: 'ip',
            className: "text-center text-nowrap"
          },
          {
            data: 'status',
            name: 'status',
            className: "text-center text-nowrap no-select"
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
          "emptyTable": "Data logs mesin tidak ditemukan.",
          "thousands": ".",
          "paginate": {
            "first": "Pertama",
            "last": "Terakhir",
            "next": "Next",
            "previous": "Prev"
          },
        },
        rowCallback: function(row, data) {
          if (data.userSnMissed === 'missed') {
            $(row).addClass('text-danger');
            $(row).css('background-color', '#fcf6f6');
          }
        },
        initComplete: function() {
          console.log('DataTable logs berhasil dibuat.');
        }
      }).buttons().container();

      // Initialize date range picker
      $('#daterange-btn').daterangepicker({
        @if (request()->routeIs('presensi.logs.filter'))
          startDate: moment(),
          endDate: moment(),
        @elseif (request()->routeIs('presensi.logs'))
          startDate: moment().startOf('month'),
            endDate: moment().endOf('month'),
        @endif
        locale: {
          format: 'DD-MM-YYYY', // Set the desired date format here
          separator: ' sampai ',
          applyLabel: 'Terapkan',
          cancelLabel: 'Batalkan',
          fromLabel: 'Dari',
          toLabel: 'Ke',
          customRangeLabel: 'Kostum',
          weekLabel: 'W',
          daysOfWeek: ['Min', 'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab'],
          monthNames: [
            'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
          ],
          firstDay: 1
        },
        ranges: {
          'Hari ini': [moment(), moment()],
          'Kemarin': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          '7 hari terakhir': [moment().subtract(6, 'days'), moment()],
          '30 hari terakhir': [moment().subtract(29, 'days'), moment()],
          'Bulan ini': [moment().startOf('month'), moment().endOf('month')],
          'Bulan kemarin': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf(
            'month')]
        },

      }, function(start, end) {
        // $('#selected-date-range').html(start.format('DD MMM YYYY') + ' - ' + end.format('DD MMM YYYY'));
        try {
          // Redirect to the new URL with start_date and end_date as query parameters
          var newURL = '{{ route('presensi.logs.filter') }}' +
            '?start_date=' + encodeURIComponent(start.format('YYYY-MM-DD')) +
            '&end_date=' + encodeURIComponent(end.format('YYYY-MM-DD'));
          window.location.href = newURL;
        } catch (error) {
          console.error("Terjadi kesalahan saat memproses filterisasi:", error);
          // Handle the error as needed, e.g., display an alert to the user
          alert("Terjadi kesalahan saat memproses filterisasi. Mohon dicoba kembali.");
        }
      });
    });

    // Selesaikan NProgress saat AJAX request selesai dan gambar-gambar dalam tabel telah dimuat
    $(document).ajaxComplete(function(event, xhr, settings) {
      const $container = $('#table_logsmesin'); // Gantilah dengan selector tabel Anda
      stopLoadingWhenImagesLoaded($container);
    });
  </script>
@endsection
