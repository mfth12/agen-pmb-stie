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
    @php
      use App\Models\Perizinan;
      use App\Models\UnitKerja;
      use App\Models\Pengguna;
    @endphp

    <section class="content">
      @if (in_array(request()->route()->uri, [
              'perizinan/diizinkan',
              'perizinan/ditolak',
              'perizinan/dibatalkan',
              'perizinan/diajukan',
          ]))
        {{-- something --}}
      @else
        @canany(['akses_superadmin', 'akses_manager'])
          <div class="container">
            <div class="row">
              <div class="col-lg-3 col-6">
                <div class="small-box bg-info">
                  <div class="inner">
                    {{-- PERIZINAN DITERIMA, KODE=1 --}}
                    <h3>
                      {{ Perizinan::where('status', Perizinan::DI_IZINKAN)->count() }}
                    </h3>
                    <p>Diterima</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-android-done"></i>
                  </div>
                  <a href="/perizinan/diizinkan" class="small-box-footer">Lihat
                    <i class="fas fa-arrow-circle-right ml-1"></i></a>
                </div>
              </div>
              {{--  --}}
              <div class="col-lg-3 col-6">
                <div class="small-box bg-secondary">
                  <div class="inner">
                    {{-- PERIZINAN DITOLAK, KODE=2 --}}
                    <h3>{{ Perizinan::where('status', Perizinan::DI_TOLAK)->count() }}</h3>
                    <p>Ditolak</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-android-close"></i>
                  </div>
                  <a href="/perizinan/ditolak" class="small-box-footer">Lihat
                    <i class="fas fa-arrow-circle-right ml-1"></i></a>
                </div>
              </div>
              {{--  --}}
              <div class="col-lg-3 col-6">
                <div class="small-box bg-secondary">
                  <div class="inner">
                    {{-- PERIZINAN DIBATALKAN, KODE=3 --}}
                    <h3>{{ Perizinan::where('status', Perizinan::DI_BATALKAN)->count() }}</h3>
                    <p>Izin dibatalkan</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-android-remove-circle"></i>
                  </div>
                  <a href="/perizinan/dibatalkan" class="small-box-footer">Lihat
                    <i class="fas fa-arrow-circle-right ml-1"></i></a>
                </div>
              </div>
              {{--  --}}
              <div class="col-lg-3 col-6">
                <div class="small-box bg-secondary">
                  <div class="inner">
                    {{-- PERIZINAN DIBATALKAN, KODE=3 --}}
                    <h3>{{ Perizinan::count() }}</h3>
                    <p class="accent-gray">Semua Pengajuan</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-android-menu"></i>
                  </div>
                  <a href="/perizinan/diajukan" class="small-box-footer">Kelola
                    <i class="fas fa-gear ml-1"></i></a>
                </div>
              </div>
              {{--  --}}
            </div>
          </div>
        @elsecanany(['akses_atasan'])
          <div class="container">
            <div class="row">
              <div class="col-lg-3 col-6">
                <div class="small-box bg-info">
                  <div class="inner">
                    {{-- PERIZINAN DITERIMA, KODE=1 --}}
                    {{-- <h3>{{ Perizinan::where('status', Perizinan::DI_IZINKAN)->count() }}</h3> --}}
                    @php
                      $unit = UnitKerja::where('ketua_id', auth()->user()->user_id)->first();
                      if ($unit) {
                          $pengguna = Pengguna::where('unitkerja', $unit->unitkerja_id)
                              ->pluck('user_id')
                              ->toArray();
                          $list_diizinkan = Perizinan::with('pengguna')
                              ->whereIn('pengguna_id', array_merge($pengguna, [auth()->user()->user_id]))
                              ->where('status', Perizinan::DI_IZINKAN)
                              ->orderBy('izin_id', 'DESC')
                              ->get();
                      } else {
                          $list_diizinkan = []; // Handle case when $unit is not found
                      }
                    @endphp
                    <h3>{{ $list_diizinkan->count() }}</h3>
                    <p>Diterima</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-android-done"></i>
                  </div>
                  <a href="/perizinan/diizinkan" class="small-box-footer">Lihat
                    <i class="fas fa-arrow-circle-right ml-1"></i></a>
                </div>
              </div>
              {{--  --}}
              <div class="col-lg-3 col-6">
                <div class="small-box bg-secondary">
                  <div class="inner">
                    {{-- PERIZINAN DITOLAK, KODE=2 --}}
                    {{-- <h3>{{ Perizinan::where('status', Perizinan::DI_TOLAK)->count() }}</h3> --}}
                    @php
                      $unit = App\Models\UnitKerja::where('ketua_id', auth()->user()->user_id)->first();
                      if ($unit) {
                          $pengguna = App\Models\Pengguna::where('unitkerja', $unit->unitkerja_id)
                              ->pluck('user_id')
                              ->toArray();
                          $list_ditolak = App\Models\Perizinan::with('pengguna')
                              ->whereIn('pengguna_id', array_merge($pengguna, [auth()->user()->user_id]))
                              ->where('status', App\Models\Perizinan::DI_TOLAK)
                              ->orderBy('izin_id', 'DESC')
                              ->get();
                      } else {
                          $list_ditolak = []; // Handle case when $unit is not found
                      }
                    @endphp
                    <h3>{{ $list_ditolak->count() }}</h3>
                    <p>Ditolak</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-android-close"></i>
                  </div>
                  <a href="/perizinan/ditolak" class="small-box-footer">Lihat
                    <i class="fas fa-arrow-circle-right ml-1"></i></a>
                </div>
              </div>
              {{--  --}}
              <div class="col-lg-3 col-6">
                <div class="small-box bg-secondary">
                  <div class="inner">
                    {{-- PERIZINAN DIBATALKAN, KODE=3 --}}
                    {{-- <h3>{{ Perizinan::where('status', Perizinan::DI_BATALKAN)->count() }}</h3> --}}
                    @php
                      $unit = App\Models\UnitKerja::where('ketua_id', auth()->user()->user_id)->first();
                      if ($unit) {
                          $pengguna = App\Models\Pengguna::where('unitkerja', $unit->unitkerja_id)
                              ->pluck('user_id')
                              ->toArray();
                          $list_dibatalkan = App\Models\Perizinan::with('pengguna')
                              ->whereIn('pengguna_id', array_merge($pengguna, [auth()->user()->user_id]))
                              ->where('status', App\Models\Perizinan::DI_BATALKAN)
                              ->orderBy('izin_id', 'DESC')
                              ->get();
                      } else {
                          $list_dibatalkan = []; // Handle case when $unit is not found
                      }
                    @endphp
                    <h3>{{ $list_dibatalkan->count() }}</h3>
                    <p>Dibatalkan</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-android-remove-circle"></i>
                  </div>
                  <a href="/perizinan/dibatalkan" class="small-box-footer">Lihat
                    <i class="fas fa-arrow-circle-right ml-1"></i></a>
                </div>
              </div>
              {{--  --}}
            </div>
          </div>
        @endcanany
      @endif
    </section>

    {{-- Main content --}}
    <section class="content">
      <div class="container">
        <div class="row">
          {{--  --}}
          <div class="col-lg-12">
            <div class="card">
              <div class="card-body">
                <div class="d-flex justify-content-lg-start">
                  @if (in_array(request()->route()->uri, [
                          'perizinan/diizinkan',
                          'perizinan/ditolak',
                          'perizinan/dibatalkan',
                          'perizinan/diajukan',
                      ]))
                    {{-- something --}}
                    <div class="form-group mr-2">
                      <a href="{{ route('perizinan.index') }}" class="btn btn-default">
                        <i class="fas fa-chevron-left mr-1"></i>Kembali
                      </a>
                    </div>
                  @else
                    @can('akses_superadmin')
                      <div>
                        <a href="{{ route('perizinan.pengajuan') }}" class="btn btn-default mb-3">
                          Tambah Izin<i class="fa-solid fa-plus ml-1"></i></a>
                      </div>
                      {{-- @elsecan('akses_pegawai') --}}
                    @else
                      <div>
                        <a href="{{ route('perizinan.pengajuan') }}" class="btn btn-default mb-3">
                          Ajukan Izin <i class="fa-solid fa-user-pen ml-1"></i></a>
                      </div>
                    @endcan
                  @endif
                </div>
                {{-- <div style="overflow-x: auto;"> --}}
                <table id="table_perizinan" class="table table-hover">
                  <thead>
                    <tr>
                      <th style="width: 1px">No.</th>
                      <th>Nama</th>
                      <th>Tanggal</th>
                      <th>Diajukan</th>
                      <th>Keperluan</th>
                      <th style="min-width: 200px">Alasan</th>
                      <th>Lama</th>
                      <th>Status</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                </table>
                {{-- </div> --}}
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
      background-color: transparent;
      border: 1px solid;
      border-radius: 1rem;
    }

    .badge-outline-danger {
      text-align: center;
      margin: 0;
      color: red;
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

  {{-- JAVASCRIPT --}}
  <script>
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
    //Date range picker
    $('#tanggal_izin_awal').datetimepicker({
      // format: 'YYYY-MM-DD hh:mm:ss',
      format: 'YYYY-MM-DD',
    });
    $('#tanggal_izin_akhir').datetimepicker({
      // format: 'YYYY-MM-DD hh:mm:ss',
      format: 'YYYY-MM-DD',
    });

    //MULAI DATATABLE
    //script untuk memanggil data json dari server dan menampilkannya berupa datatable
    $(document).ready(function() {
      $('#table_perizinan').DataTable({
        info: true,
        autoWidth: false, //mengatur lebar width pada table otomatis
        scrollX: true,
        lengthChange: true, //apakah jumlah row statik atau bisa berubah
        lengthMenu: [
          [15, 30, -1],
          [15, 30, "Semua"]
        ], //jumlah data yang ditampilkan
        processing: true,
        serverSide: true, //aktifkan server-side 
        // KONDISI JIKA DIFILTER
        ajax: {
          @if (request()->route()->uri == 'perizinan/diizinkan')
            url: "{{ route('perizinan.diizinkan') }}",
          @elseif (request()->route()->uri == 'perizinan/ditolak')
            url: "{{ route('perizinan.ditolak') }}",
          @elseif (request()->route()->uri == 'perizinan/dibatalkan')
            url: "{{ route('perizinan.dibatalkan') }}",
          @elseif (request()->route()->uri == 'perizinan/diajukan')
            url: "{{ route('perizinan.diajukan') }}",
          @else
            url: "{{ route('perizinan.index') }}",
          @endif
          type: 'GET'
        },
        columns: [{
          data: null,
          sortable: true, //harusnya false
          render: function(data, type, row, meta) {
            return meta.row + meta.settings._iDisplayStart + 1;
          }
        }, {
          data: 'nama',
          name: 'nama',
          className: "text-left"
        }, {
          data: 'tanggal_ajuan',
          name: 'tanggal_ajuan',
          className: ""
        }, {
          data: 'terbaca',
          name: 'terbaca',
          className: "text-center text-nowrap"
        }, {
          data: 'keperluan_izin',
          name: 'keperluan_izin',
          className: "text-center"
        }, {
          data: 'alasan',
          name: 'alasan',
          className: "text-left"
        }, {
          data: 'berapa_lama',
          name: 'berapa_lama',
          className: "text-center"
        }, {
          data: 'status',
          name: 'status',
          className: "text-center text-nowrap"
        }, {
          data: 'aksi',
          name: 'aksi',
          className: "text-right trigger-icon"
        }, ],
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
          },
        },
      }).buttons().container();
    });

    @can('akses_superadmin_manager')
      //jika klik class delete (yang ada pada tombol delete) maka tampilkan modal konfirmasi hapus maka
      $(document).on('click', '.delete', function() {
        dataId = $(this).attr('id');
        $('#hapus-modal').modal('show');
      });
      //jika tombol hapus pada modal konfirmasi di klik maka
      $('#tombol-hapus').click(function() {
        $.ajax({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          url: "/perizinan/" + dataId, //eksekusi ajax ke url ini
          type: 'delete',
          beforeSend: function() {
            $('#tombol-hapus').text('Hapus'); //set text untuk tombol hapus
            $('#tombol-hapus').focus(); //set focus
          },
          success: function(data) { //jika sukses
            setTimeout(function() {
              $('#hapus-modal').modal('hide'); //sembunyikan konfirmasi modal
              var oTable = $('#table_perizinan').dataTable();
              oTable.fnDraw(false); //reset datatable
            });
            iziToast.warning({ //tampilkan izitoast warning
              title: `Ok.`,
              message: `Data izin berhasil dihapus`,
              position: `topCenter`
            });
          }
        })
      });
    @endcan

    // Selesaikan NProgress saat AJAX request selesai dan gambar-gambar dalam tabel telah dimuat
    $(document).ajaxComplete(function(event, xhr, settings) {
      const $container = $('#table_perizinan'); // Gantilah dengan selector tabel Anda
      stopLoadingWhenImagesLoaded($container);
    });

    // akhir script
  </script>
@endsection
