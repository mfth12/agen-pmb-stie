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
      use App\Models\Percutian;
      use App\Models\UnitKerja;
      use App\Models\Pengguna;
    @endphp

    <section class="content">
      @if (in_array(request()->route()->uri, [
              'percutian/disetujui_pimpinan',
              'percutian/diizinkan_atasan',
              'percutian/ditolak',
              'percutian/dibatalkan',
              'percutian/diajukan',
          ]))
        {{-- something --}}
      @else
        @canany(['akses_superadmin', 'akses_manager'])
          <div class="container">
            <div class="row">
              <div class="col-lg-2 col-6">
                <div class="small-box bg-success">
                  <div class="inner">
                    <h3>{{ Percutian::where('status', Percutian::DI_SETUJUI_PIMPINAN)->count() }}</h3>
                    <p>Disetujui Pimpinan</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-android-done-all"></i>
                  </div>
                  <a href="/percutian/disetujui_pimpinan" class="small-box-footer">Detail
                    <i class="fas fa-arrow-circle-right ml-1"></i></a>
                </div>
              </div>
              {{--  --}}
              <div class="col-lg-2 col-6">
                <div class="small-box bg-secondary">
                  <div class="inner">
                    <h3>{{ Percutian::where('status', Percutian::DI_IZINKAN_ATASAN)->count() }}</h3>
                    <p>Diizinkan Atasan</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-android-done"></i>
                  </div>
                  <a href="/percutian/diizinkan_atasan" class="small-box-footer">Detail
                    <i class="fas fa-arrow-circle-right ml-1"></i></a>
                </div>
              </div>
              {{--  --}}
              <div class="col-lg-2 col-6">
                <div class="small-box bg-secondary">
                  <div class="inner">
                    <h3>{{ Percutian::where('status', Percutian::DI_TOLAK)->count() }}</h3>
                    <p>Pengajuan Ditolak</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-android-close"></i>
                  </div>
                  <a href="/percutian/ditolak" class="small-box-footer">Detail
                    <i class="fas fa-arrow-circle-right ml-1"></i></a>
                </div>
              </div>
              {{--  --}}
              <div class="col-lg-2 col-6">
                <div class="small-box bg-secondary">
                  <div class="inner">
                    <h3>{{ Percutian::where('status', Percutian::DI_BATALKAN)->count() }}</h3>
                    <p>Pengajuan Dibatalkan</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-android-remove-circle"></i>
                  </div>
                  <a href="/percutian/dibatalkan" class="small-box-footer">Detail
                    <i class="fas fa-arrow-circle-right ml-1"></i></a>
                </div>
              </div>
              {{--  --}}
              <div class="col-lg-2 col-6">
                <div class="small-box bg-secondary">
                  <div class="inner">
                    <h3>{{ Percutian::count() }}</h3>
                    <p class="accent-gray">Semua Pengajuan</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion ion-android-menu"></i>
                  </div>
                  <a href="/percutian/diajukan" style="color: light" class="small-box-footer">Kelola
                    <i class="fas fa-gear"></i></a>
                </div>
              </div>
              {{--  --}}
              <div class="col-lg-2 col-6">
                <div class="small-box card accent-gray">
                  <div class="inner" style="color: rgb(88, 88, 88)">
                    <h3>{{ App\Models\kategori_cuti::count() }}</h3>
                    <p>Kategori Cuti</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-ios-gear"></i>
                  </div>
                  <a href="javascript:void(0)" onclick="pengaturan()" style="color: light"
                    class="small-box-footer">Pengaturan<i class="fas fa-gear ml-1"></i></a>
                </div>
              </div>
              {{--  --}}
            </div>
          </div>
        @elsecanany(['akses_atasan'])
          <div class="container">
            <div class="row">
              <div class="col-lg-3 col-6">
                <div class="small-box bg-success">
                  <div class="inner">
                    {{-- <h3>{{ Percutian::where('status', Percutian::DI_SETUJUI_PIMPINAN)->count() }}</h3> --}}
                    @php
                      $unit = UnitKerja::where('ketua_id', auth()->user()->user_id)->first();
                      if ($unit) {
                          $pengguna_cuti = Pengguna::where('unitkerja', $unit->unitkerja_id)
                              ->pluck('user_id')
                              ->toArray();
                          $list_disetujui_waka_ii = Percutian::with('pengguna')
                              ->whereIn('pengguna_id', array_merge($pengguna_cuti, [auth()->user()->user_id]))
                              ->where('status', Percutian::DI_SETUJUI_PIMPINAN)
                              ->orderBy('cuti_id', 'DESC')
                              ->get();
                      } else {
                          $list_disetujui_waka_ii = []; // Handle case when $unit is not found
                      }
                    @endphp
                    <h3>{{ $list_disetujui_waka_ii->count() }}</h3>
                    <p>Disetujui Pimpinan</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-android-done-all"></i>
                  </div>
                  <a href="/percutian/disetujui_pimpinan" class="small-box-footer">Detail
                    <i class="fas fa-arrow-circle-right ml-1"></i></a>
                </div>
              </div>
              {{--  --}}
              <div class="col-lg-2 col-6">
                <div class="small-box bg-secondary">
                  <div class="inner">
                    {{-- <h3>{{ Percutian::where('status', Percutian::DI_SETUJUI_PIMPINAN)->count() }}</h3> --}}
                    @php
                      $unit = UnitKerja::where('ketua_id', auth()->user()->user_id)->first();
                      if ($unit) {
                          $pengguna_cuti = Pengguna::where('unitkerja', $unit->unitkerja_id)
                              ->pluck('user_id')
                              ->toArray();
                          $list_diizinkan = Percutian::with('pengguna')
                              ->whereIn('pengguna_id', array_merge($pengguna_cuti, [auth()->user()->user_id]))
                              ->where('status', Percutian::DI_IZINKAN_ATASAN)
                              ->orderBy('cuti_id', 'DESC')
                              ->get();
                      } else {
                          $list_diizinkan = []; // Handle case when $unit is not found
                      }
                    @endphp
                    <h3>{{ $list_diizinkan->count() }}</h3>
                    <p>Diizinkan Atasan</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-android-done"></i>
                  </div>
                  <a href="/percutian/diizinkan_atasan" class="small-box-footer">Detail
                    <i class="fas fa-arrow-circle-right ml-1"></i></a>
                </div>
              </div>
              {{--  --}}
              <div class="col-lg-2 col-6">
                <div class="small-box bg-secondary">
                  <div class="inner">
                    {{-- <h3>{{ Percutian::where('status', Percutian::DI_TOLAK)->count() }}</h3> --}}
                    @php
                      $unit = UnitKerja::where('ketua_id', auth()->user()->user_id)->first();
                      if ($unit) {
                          $pengguna_cuti = Pengguna::where('unitkerja', $unit->unitkerja_id)
                              ->pluck('user_id')
                              ->toArray();
                          $list_ditolak = Percutian::with('pengguna')
                              ->whereIn('pengguna_id', array_merge($pengguna_cuti, [auth()->user()->user_id]))
                              ->where('status', Percutian::DI_TOLAK)
                              ->orderBy('cuti_id', 'DESC')
                              ->get();
                      } else {
                          $list_ditolak = []; // Handle case when $unit is not found
                      }
                    @endphp
                    <h3>{{ $list_ditolak->count() }}</h3>
                    <p>Pengajuan Ditolak</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-android-close"></i>
                  </div>
                  <a href="/percutian/ditolak" class="small-box-footer">Detail
                    <i class="fas fa-arrow-circle-right ml-1"></i></a>
                </div>
              </div>
              {{--  --}}
              <div class="col-lg-2 col-6">
                <div class="small-box bg-secondary">
                  <div class="inner">
                    {{-- <h3>{{ Percutian::where('status', Percutian::DI_BATALKAN)->count() }}</h3> --}}
                    @php
                      $unit = UnitKerja::where('ketua_id', auth()->user()->user_id)->first();
                      if ($unit) {
                          $pengguna_cuti = Pengguna::where('unitkerja', $unit->unitkerja_id)
                              ->pluck('user_id')
                              ->toArray();
                          $list_dibatalkan = Percutian::with('pengguna')
                              ->whereIn('pengguna_id', array_merge($pengguna_cuti, [auth()->user()->user_id]))
                              ->where('status', Percutian::DI_BATALKAN)
                              ->orderBy('cuti_id', 'DESC')
                              ->get();
                      } else {
                          $list_dibatalkan = []; // Handle case when $unit is not found
                      }
                    @endphp
                    <h3>{{ $list_dibatalkan->count() }}</h3>
                    <p>Pengajuan Dibatalkan</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-android-remove-circle"></i>
                  </div>
                  <a href="/percutian/dibatalkan" class="small-box-footer">Detail
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
                          'percutian/disetujui_pimpinan',
                          'percutian/diizinkan_atasan',
                          'percutian/ditolak',
                          'percutian/dibatalkan',
                          'percutian/diajukan',
                      ]))
                    <div class="form-group mr-2">
                      <a href="{{ route('percutian.index') }}" class="btn btn-default">
                        <i class="fas fa-chevron-left mr-1"></i>Kembali
                      </a>
                    </div>
                  @else
                    @can('akses_superadmin_manager')
                      <div>
                        <a href="{{ route('percutian.pengajuan') }}" class="btn btn-default mb-3">
                          Tambah Cuti<i class="fa-solid fa-plus ml-1"></i></a>
                      </div>
                    @else
                      <div>
                        <a href="{{ route('percutian.pengajuan') }}" class="btn btn-default mb-3">
                          Ajukan Cuti <i class="fa-solid fa-user-pen ml-1"></i></a>
                      </div>
                    @endcan
                  @endif
                </div>

                {{-- <div style="overflow-x: auto;"> --}}
                <table id="table_percutian" class="table table-hover">
                  <thead>
                    <tr>
                      <th style="width: 1px">No.</th>
                      <th>Nama</th>
                      <th>Tanggal</th>
                      <th>Diajukan</th>
                      <th>Kategori</th>
                      <th style="min-width: 200px">Keperluan</th>
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

  {{-- MULAI MODAL FORM PENGATURAN --}}
  <div class="modal fade" id="pengaturan-modal" data-backdrop="static" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modal-judul"></h5>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <div class="container">
            <div class="row">
              {{-- kolom kiri --}}
              <div class="col-md-8">
                <div class="card card-default">
                  <div class="card-body">
                    <table class="table table-sm table-borderless">
                      <tr>
                        <td></td>
                      </tr>
                      <tr>
                        <td></td>
                      </tr>
                    </table>
                    <hr>
                  </div>
                </div>
              </div>
              {{-- kolom kanan --}}
              <div class="col-md-4">
                <div class="card card-default">
                  <div class="card-body" style="padding-bottom: 0em">
                    <strong><i class="fas fa-user-tie mr-1"></i> Pimpinan Berwenang</strong>
                    <p onclick="modal_onModal()">Nama Lengkap Pegawai</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  {{-- MULAI MODAL TAMBAHAN --}}
  <div class="modal fade" id="tambahan-modal" data-backdrop="static" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modal-tambahan-judul"></h5>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <div class="container">
            <div class="row">
              {{-- kolom kanan --}}
              <div class="col-md-12">
                <div class="card card-default">
                  <div class="card-body" style="padding-bottom: 0em">
                    <strong><i class="fas fa-user-tie mr-1"></i> Pimpinan Berwenang</strong>
                    <p onclick="modal_onModal()">Nama Lengkap Pegawai</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  {{-- AKHIR MODAL --}}

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
    $('#tanggal_cuti_awal').datetimepicker({
      // format: 'YYYY-MM-DD hh:mm:ss',
      format: 'YYYY-MM-DD',
    });
    $('#tanggal_cuti_akhir').datetimepicker({
      // format: 'YYYY-MM-DD hh:mm:ss',
      format: 'YYYY-MM-DD',
    });

    //MULAI DATATABLE
    //script untuk memanggil data json dari server dan menampilkannya berupa datatable
    $(document).ready(function() {
      $('#table_percutian').DataTable({
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
          @if (request()->route()->uri == 'percutian/disetujui_pimpinan')
            url: "{{ route('percutian.disetujui_pimpinan') }}",
          @elseif (request()->route()->uri == 'percutian/diizinkan_atasan')
            url: "{{ route('percutian.diizinkan_atasan') }}",
          @elseif (request()->route()->uri == 'percutian/ditolak')
            url: "{{ route('percutian.ditolak') }}",
          @elseif (request()->route()->uri == 'percutian/dibatalkan')
            url: "{{ route('percutian.dibatalkan') }}",
          @elseif (request()->route()->uri == 'percutian/diajukan')
            url: "{{ route('percutian.diajukan') }}",
          @else
            url: "{{ route('percutian.index') }}",
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
          data: 'kategori_cuti',
          name: 'kategori_cuti',
          className: "text-center"
        }, {
          data: 'keperluan_cuti', //sama dengan alasan
          name: 'keperluan_cuti', //sama dengan alasan
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
          url: "/percutian/" + dataId, //eksekusi ajax ke url ini
          type: 'delete',
          beforeSend: function() {
            $('#tombol-hapus').text('Hapus'); //set text untuk tombol hapus
            $('#tombol-hapus').focus(); //set focus
          },
          success: function(data) { //jika sukses
            setTimeout(function() {
              $('#hapus-modal').modal('hide'); //sembunyikan konfirmasi modal
              var oTable = $('#table_percutian').dataTable();
              oTable.fnDraw(false); //reset datatable
            });
            iziToast.warning({ //tampilkan izitoast warning
              title: `Ok.`,
              message: `Data cuti berhasil dihapus`,
              position: `topCenter`
            });
          }
        })
      });
    @endcan

    // Panggil modal pengaturan
    function pengaturan() {
      $('#pengaturan-modal').modal('show');
      $('#modal-judul').html("Pengaturan Cuti");
    }

    // Panggil modal pengaturan
    function modal_onModal() {
      $('#tambahan-modal').modal('show');
      $('#modal-tambahan-judul').html("Modal Tambahan");
    }

    // Selesaikan NProgress saat AJAX request selesai dan gambar-gambar dalam tabel telah dimuat
    $(document).ajaxComplete(function(event, xhr, settings) {
      const $container = $('#table_percutian'); // Gantilah dengan selector tabel Anda
      stopLoadingWhenImagesLoaded($container);
    });

    // Akhir script
  </script>
@endsection
