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
          <div class="col-md-12 col-sm-12 col-12">
            {{-- BAR CHART --}}
            <div class="card card-default">
              <div class="card-header">
                <h3 class="card-title">Statistik</h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <div class="chart">
                  <canvas id="barChart"
                    style="min-height: 180px; height: 230px; max-height: 300px; max-width: 100%;"></canvas>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-body" style="padding: 8px">
                <div class="row">
                  <div class="col-lg-6" style="padding: 0px">
                    {{-- tabel-1 --}}
                    <table id="tabel1" class="table table-hover table-valign-middle">
                      <thead>
                        <tr>
                          <th class="text-center" style="width: 1px;">No.</th>
                          <th>Foto</th>
                          <th>Nama</th>
                          <th colspan="2" class="text-center" style="width: 1px;">Keterangan</th>
                          {{-- Menggabungkan kolom Masuk dan Pulang --}}
                        </tr>
                      </thead>
                    </table>
                  </div>
                  <div class="col-lg-6" style="padding: 0px">
                    {{-- tabel-2 --}}
                    <table id="tabel2" class="table table-hover">
                      <thead>
                        <tr>
                          <th class="text-center" style="width: 1px;">No.</th>
                          <th>Foto</th>
                          <th>Nama</th>
                          <th colspan="2" class="text-center" style="width: 1px;">Keterangan</th>
                          {{-- Menggabungkan kolom Masuk dan Pulang --}}
                        </tr>
                      </thead>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection

@section('js_atas')
  {{-- masih kosong --}}
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

    /* Menghilangkan garis atas pada tabel DataTables */
    .dataTables_wrapper .dataTables_scrollHeadInner table thead th {
      border-top: none !important;
    }

    .dataTables_wrapper .dataTables_scrollHeadInner table thead {
      border-top: none !important;
    }
  </style>
@endsection

@section('js_bawah')
  <script src="{{ asset('js/plugins/sparkline.js') }}"></script>
  <script src="{{ asset('js/plugins/chart.js/Chart.min.js') }}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.1/anime.min.js"></script>

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

    // MULAI DATATABLE
    // script untuk memanggil data json dari server dan menampilkannya berupa datatable
    $(document).ready(function() {
      // Fungsi untuk mengatur penomoran ganjil/genap
      function renderNumbering(data, type, row, meta, filter) {
        let start = meta.settings._iDisplayStart + 1;
        let increment = filter === 'odd' ? 2 : 2;
        let startNumber = filter === 'odd' ? 1 : 2;
        return startNumber + (meta.row * increment);
      }

      // Inisialisasi tabel kiri (ganjil)
      $('#tabel1').DataTable({
        info: false,
        paginate: false,
        searching: false,
        autoWidth: false,
        scrollX: true,
        colReorder: true,
        lengthChange: true,
        ordering: false,
        lengthMenu: [
          [25, 50, 100, 150, -1],
          [25, 50, 100, 150, "Semua"]
        ],
        processing: true,
        deferRender: true,
        serverSide: true,
        ajax: {
          url: "{{ route('presensi.harian') }}",
          type: 'GET',
          data: function(d) {
            d.filter = 'odd'; // Menandai bahwa ini untuk data ganjil
          }
        },
        columns: [{
            data: null,
            sortable: false,
            className: "text-center", // Menambahkan class text-center untuk meratakan teks ke tengah
            render: function(data, type, row, meta) {
              return renderNumbering(data, type, row, meta, 'odd');
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
            data: 'status1',
            name: 'status1',
            className: "text-center text-nowrap"
          },
          {
            data: 'status2',
            name: 'status2',
            className: "text-center text-nowrap"
          }
        ],
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
          console.log('Data presensi selesai digenerate untuk tabel1.');
        }
      });

      // Inisialisasi tabel kanan (genap)
      $('#tabel2').DataTable({
        info: false,
        paginate: false,
        searching: false,
        autoWidth: false,
        scrollX: true,
        colReorder: true,
        lengthChange: true,
        ordering: false,
        lengthMenu: [
          [25, 50, 100, 150, -1],
          [25, 50, 100, 150, "Semua"]
        ],
        processing: true,
        deferRender: true,
        serverSide: true,
        ajax: {
          url: "{{ route('presensi.harian') }}",
          type: 'GET',
          data: function(d) {
            d.filter = 'even'; // Menandai bahwa ini untuk data genap
          }
        },
        columns: [{
            data: null,
            sortable: false,
            className: "text-center", // Menambahkan class text-center untuk meratakan teks ke tengah
            render: function(data, type, row, meta) {
              return renderNumbering(data, type, row, meta, 'even');
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
            data: 'status1',
            name: 'status1',
            className: "text-center text-nowrap"
          },
          {
            data: 'status2',
            name: 'status2',
            className: "text-center text-nowrap"
          }
        ],
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
          console.log('Data presensi selesai digenerate untuk tabel2.');
        }
      });
    });


    $(function() {
      /* ChartJS
       * -------
       * Here we will create a few charts using ChartJS
       */

      var primaryChartData = {
        labels: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober',
          'November', 'Desember'
        ],
        datasets: [{
            label: 'Kehadiran',
            backgroundColor: 'rgba(60,141,188,0.9)',
            borderColor: 'rgba(60,141,188,0.8)',
            pointRadius: false,
            pointColor: '#3b8bba',
            pointStrokeColor: 'rgba(60,141,188,1)',
            pointHighlightFill: '#fff',
            pointHighlightStroke: 'rgba(60,141,188,1)',
            data: [28, 48, 40, 19, 86, 27, 120, 65, 59, 80, 116, 56, 55, 40]
          },
          {
            label: 'Ekspektasi',
            backgroundColor: 'rgba(210, 214, 222, 1)',
            borderColor: 'rgba(210, 214, 222, 1)',
            pointRadius: false,
            pointColor: 'rgba(210, 214, 222, 1)',
            pointStrokeColor: '#c1c7d1',
            pointHighlightFill: '#fff',
            pointHighlightStroke: 'rgba(220,220,220,1)',
            data: [65, 59, 80, 116, 56, 55, 40, 28, 48, 40, 19, 86, 27, 120]
          },
        ]
      }

      var primaryChartOptions = {
        maintainAspectRatio: false,
        responsive: true,
        legend: {
          display: false
        },
        scales: {
          xAxes: [{
            gridLines: {
              display: false,
            }
          }],
          yAxes: [{
            gridLines: {
              display: false,
            }
          }]
        }
      }


      //-------------
      //- BAR CHART -
      //-------------
      var barChartCanvas = $('#barChart').get(0).getContext('2d')
      var barChartData = $.extend(true, {}, primaryChartData)
      var temp0 = primaryChartData.datasets[0]
      var temp1 = primaryChartData.datasets[1]
      barChartData.datasets[0] = temp1
      barChartData.datasets[1] = temp0

      var barChartOptions = {
        responsive: true,
        maintainAspectRatio: false,
        datasetFill: false
      }

      new Chart(barChartCanvas, {
        type: 'bar',
        data: barChartData,
        options: barChartOptions
      })
    })

    // Selesaikan NProgress saat AJAX request selesai dan gambar-gambar dalam tabel telah dimuat
    $(document).ajaxComplete(function(event, xhr, settings) {
      const $container = $('#tabel1, #tabel2'); // Gantilah dengan selector tabel Anda
      stopLoadingWhenImagesLoaded($container);
    });
  </script>
@endsection
