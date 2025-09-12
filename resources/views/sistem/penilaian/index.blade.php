@php
  use App\Models\Penilaian;
  use App\Models\UnitKerja;
  use App\Models\Pengguna;
@endphp

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


    <section class="content">
      @if (in_array(request()->route()->uri, [
              'penilaian/semua',
              'penilaian/dibuat',
              'penilaian/dinilaiatasan',
              'penilaian/diterima',
              'penilaian/ditolak',
              'penilaian/dibatalkan',
          ]))
        {{-- something --}}
      @else
        @canany(['akses_superadmin_manager'])
          <div class="container">
            {{-- ROW ATAS --}}
            <div class="row">
              <div class="col-lg-3 col-4">
                <div class="small-box bg-success">
                  <div class="inner">
                    <h3>
                      {{ Penilaian::where('status', Penilaian::DI_TERIMA_PIMP)->count() }}
                    </h3>
                    <p>Diterima Pimpinan</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-android-done-all"></i>
                  </div>
                  <a href="{{ route('penilaian.diterima') }}" class="small-box-footer">Lihat <i
                      class="fas fa-arrow-circle-right"></i></a>
                </div>
              </div>
              {{--  --}}
              <div class="col-lg-3 col-4">
                <div class="small-box bg-secondary">
                  <div class="inner">
                    <h3>{{ Penilaian::where('status', Penilaian::DI_NILAI_ATASAN)->count() }}</h3>
                    <p>Dinilai Atasan</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-android-done"></i>
                  </div>
                  <a href="{{ route('penilaian.dinilaiatasan') }}" class="small-box-footer">Lihat <i
                      class="fas fa-arrow-circle-right"></i></a>
                </div>
              </div>
              {{--  --}}
              <div class="col-lg-3 col-4">
                <div class="small-box bg-secondary">
                  <div class="inner">
                    <h3>{{ Penilaian::where('status', Penilaian::DI_NILAI)->count() }}</h3>
                    <p>Dinilai Mandiri</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-android-radio-button-on"></i>
                  </div>
                  <a href="{{ route('penilaian.dibuat') }}" class="small-box-footer">Lihat <i
                      class="fas fa-arrow-circle-right"></i></a>
                </div>
              </div>
              <div class="col-lg-3 col-4">
                <div class="small-box bg-secondary">
                  <div class="inner">
                    <h3>{{ Penilaian::where('status', Penilaian::DI_BATALKAN)->count() }}</h3>
                    <p class="accent-gray">Dibatalkan</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-android-remove-circle"></i>
                  </div>
                  <a href="{{ route('penilaian.dibatalkan') }}" class="small-box-footer">Kelola <i
                      class="fas fa-gear"></i></a>
                </div>
              </div>
              {{--  --}}

              <div class="col-lg-3 col-4">
                <div class="small-box bg-secondary">
                  <div class="inner">
                    <h3>{{ Penilaian::where('status', Penilaian::DI_TOLAK)->count() }}</h3>
                    <p>Ditolak</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-android-close"></i>
                  </div>
                  <a href="{{ route('penilaian.ditolak') }}" class="small-box-footer">Lihat <i
                      class="fas fa-arrow-circle-right"></i></a>
                </div>
              </div>
              {{--  --}}
              <div class="col-lg-3 col-4">
                <div class="small-box bg-secondary">
                  <div class="inner">
                    {{-- PERIZINAN SEMUA --}}
                    <h3>{{ Penilaian::count() }}</h3>
                    <p class="accent-gray">Semua Penilaian</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-android-menu"></i>
                  </div>
                  <a href="{{ route('penilaian.semua') }}" class="small-box-footer">Kelola <i class="fas fa-gear"></i></a>
                </div>
              </div>
            </div>
          </div>
        @elsecanany(['akses_atasan'])
          <div class="container">
            <div class="row">
              <div class="col-lg-3 col-6">
                <div class="small-box bg-secondary">
                  <div class="inner">
                    @php
                      $unit = UnitKerja::where('ketua_id', auth()->user()->user_id)->first();
                      if ($unit) {
                          $pengguna = Pengguna::where('unitkerja', $unit->unitkerja_id)
                              ->pluck('user_id')
                              ->toArray();
                          $list_diterima_pimp = Penilaian::with('yg_dinilai')
                              ->whereIn('yg_dinilai_id', array_merge($pengguna, [auth()->user()->user_id]))
                              ->where('status', Penilaian::DI_TERIMA_PIMP)
                              ->orderBy('penilaian_id', 'DESC')
                              ->get();
                      } else {
                          $list_diterima_pimp = []; // Handle case when $unit is not found
                      }
                    @endphp
                    <h3>{{ $list_diterima_pimp->count() }}</h3>
                    <p>Diterima Pimpinan</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-android-done-all"></i>
                  </div>
                  <a href="{{ route('penilaian.diterima') }}" class="small-box-footer">Lihat <i
                      class="fas fa-arrow-circle-right"></i></a>
                </div>
              </div>
              {{--  --}}
              <div class="col-lg-3 col-6">
                <div class="small-box bg-secondary">
                  <div class="inner">
                    @php
                      $unit = UnitKerja::where('ketua_id', auth()->user()->user_id)->first();
                      if ($unit) {
                          $pengguna = Pengguna::where('unitkerja', $unit->unitkerja_id)
                              ->pluck('user_id')
                              ->toArray();
                          $list_dinilai_atasan = Penilaian::with('yg_dinilai')
                              ->whereIn('yg_dinilai_id', array_merge($pengguna, [auth()->user()->user_id]))
                              ->where('status', Penilaian::DI_NILAI_ATASAN)
                              ->orderBy('penilaian_id', 'DESC')
                              ->get();
                      } else {
                          $list_dinilai_atasan = []; // Handle case when $unit is not found
                      }
                    @endphp
                    <h3>{{ $list_dinilai_atasan->count() }}</h3>
                    <p>Dinilai Atasan</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-android-done"></i>
                  </div>
                  <a href="{{ route('penilaian.dinilaiatasan') }}" class="small-box-footer">Lihat <i
                      class="fas fa-arrow-circle-right"></i></a>
                </div>
              </div>
              {{--  --}}
              <div class="col-lg-3 col-6">
                <div class="small-box bg-secondary">
                  <div class="inner">
                    @php
                      $unit = UnitKerja::where('ketua_id', auth()->user()->user_id)->first();
                      if ($unit) {
                          $pengguna = Pengguna::where('unitkerja', $unit->unitkerja_id)
                              ->pluck('user_id')
                              ->toArray();
                          $list_dinilai_mandiri = Penilaian::with('yg_dinilai')
                              ->whereIn('yg_dinilai_id', array_merge($pengguna, [auth()->user()->user_id]))
                              ->where('status', Penilaian::DI_NILAI)
                              ->orderBy('penilaian_id', 'DESC')
                              ->get();
                      } else {
                          $list_dinilai_mandiri = []; // Handle case when $unit is not found
                      }
                    @endphp
                    <h3>{{ $list_dinilai_mandiri->count() }}</h3>
                    <p>Dinilai Mandiri</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-android-radio-button-on"></i>
                  </div>
                  <a href="{{ route('penilaian.dibuat') }}" class="small-box-footer">Lihat <i
                      class="fas fa-arrow-circle-right"></i></a>
                </div>
              </div>
              {{--  --}}
              <div class="col-lg-3 col-6">
                <div class="small-box bg-secondary">
                  <div class="inner">
                    @php
                      $unit = UnitKerja::where('ketua_id', auth()->user()->user_id)->first();
                      if ($unit) {
                          $pengguna = Pengguna::where('unitkerja', $unit->unitkerja_id)
                              ->pluck('user_id')
                              ->toArray();
                          $list_dinilai_mandiri = Penilaian::with('yg_dinilai')
                              ->whereIn('yg_dinilai_id', array_merge($pengguna, [auth()->user()->user_id]))
                              ->where('status', Penilaian::DI_NILAI)
                              ->orderBy('penilaian_id', 'DESC')
                              ->get();
                      } else {
                          $list_dinilai_mandiri = []; // Handle case when $unit is not found
                      }
                    @endphp
                    <h3>{{ $list_dinilai_mandiri->count() }}</h3>
                    <p>Dibatalkan</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-android-remove-circle"></i>
                  </div>
                  <a href="{{ route('penilaian.dibuat') }}" class="small-box-footer">Lihat <i
                      class="fas fa-arrow-circle-right"></i></a>
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

            <div class="card card-default">
              <div class="card-body">
                <div class="d-flex justify-content-lg-start">
                  @if (in_array(request()->route()->uri, [
                          'penilaian/semua',
                          'penilaian/dibuat',
                          'penilaian/dinilaiatasan',
                          'penilaian/diterima',
                          'penilaian/ditolak',
                          'penilaian/dibatalkan',
                      ]))
                    {{-- something --}}
                    <div class="form-group mr-2">
                      <a href="{{ route('penilaian.index') }}" class="btn btn-default">
                        <i class="fas fa-chevron-left mr-1"></i>Kembali
                      </a>
                    </div>
                  @else
                    <div>
                      <a href="{{ route('penilaian.buat') }}" class="btn btn-default mb-3">
                        Buat Penilaian<i class="fa-solid fa-plus ml-1"></i></a>
                    </div>
                  @endif
                </div>
                <div style="overflow-x: auto;">
                  <table id="table_pennilaian" class="table table-hover">
                    <thead>
                      <tr>
                        <th style="width: 1px">No.</th>
                        <th style="width: 1px">Foto</th>
                        <th>Nama</th>
                        <th style="width: 1px">Jenis</th>
                        <th>Hari Tanggal</th>
                        <th>Nilai Akhir</th>
                        <th>Periode</th>
                        <th style="width: 1px">Status</th>
                        <th style="width: 50px">Aksi</th>
                      </tr>
                    </thead>
                  </table>
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

    .table-avatar img,
    img.table-avatar {
      border-radius: 50%;
      display: inline;
      width: 1.8rem;
    }

    .underlined {
      text-decoration: underline;
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

    function lihatGambar() {
      const gambar = document.querySelector('#bukti');
      const gambarPreview = document.querySelector('.img-lihat')
      // const ganti = document.querySelector('#upload')

      gambarPreview.style.display = 'block';
      const oFReader = new FileReader();
      oFReader.readAsDataURL(gambar.files[0]);

      oFReader.onload = function(oFREvent) {
        gambarPreview.src = oFREvent.target.result;
      }
    }
    //TOMBOL TAMBAH DATA
    //jika tombol-tambah diklik maka
    $('#tombol-tambah').click(function() {
      $('#tombol-simpan').val("create-post"); //valuenya menjadi create-post
      $('#pengguna_id').val(''); //valuenya menjadi kosong
      $('.is-invalid').removeClass('is-invalid'); // Menghapus kelas is-invalid pada elemen input jika valid
      // $('.invalid-feedback').removeClass('invalid-feedback'); // Menghapus kelas is-invalid pada elemen input jika valid
      $('.invalid-feedback').remove(); // Menghapus elemen dengan class invalid-feedback
      $('#form-tambah-edit').trigger("reset"); //mereset semua input dll didalamnya
      $('#modal-judul').html("Buat Izin Baru"); //valuenya tambah pegawai baru
      $('#tambah-edit-modal').modal('show'); //modal tampil
      $('#tombol-simpan').html('Buat Izin'); //ubah teks tombol

      // // Perbarui nilai input tanggal_ajuan dengan timestamp saat ini
      // var currentTimestamp = Math.floor(Date.now() / 1000); // Timestamp saat ini dalam detik
      // $('#tanggal_ajuan').val(currentTimestamp);
    });

    //MULAI DATATABLE
    //script untuk memanggil data json dari server dan menampilkannya berupa datatable
    $(document).ready(function() {
      $('#table_pennilaian').DataTable({
        info: true,
        autoWidth: true, //mengatur lebar width pada table otomatis
        // scrollX: true,
        lengthChange: true, //apakah jumlah row statik atau bisa berubah
        lengthMenu: [
          [15, 30, -1],
          [15, 30, "Semua"]
        ], //jumlah data yang ditampilkan

        processing: true,
        serverSide: true, //aktifkan server-side 

        // KONDISI JIKA DIFILTER
        // KONDISI JIKA DIFILTER
        ajax: {
          url: (function() {
            @switch(request()->route()->uri)
              @case('penilaian/semua')
              return "{{ route('penilaian.semua') }}";
              @break

              @case('penilaian/dibuat')
              return "{{ route('penilaian.dibuat') }}";
              @break

              @case('penilaian/dinilaiatasan')
              return "{{ route('penilaian.dinilaiatasan') }}";
              @break

              @case('penilaian/diterima')
              return "{{ route('penilaian.diterima') }}";
              @break

              @case('penilaian/ditolak')
              return "{{ route('penilaian.ditolak') }}";
              @break

              @case('penilaian/dibatalkan')
              return "{{ route('penilaian.dibatalkan') }}";
              @break

              @default
              return "{{ route('penilaian.index') }}";
            @endswitch
          })(),
          type: 'GET'
        },
        columns: [{
          data: null,
          sortable: true, //harusnya false
          className: "text-center",
          render: function(data, type, row, meta) {
            return meta.row + meta.settings._iDisplayStart + 1;
          }
        }, {
          data: 'foto',
          name: 'foto',
          className: "text-left"
        }, {
          data: 'nama',
          name: 'nama',
          className: "text-left"
        }, {
          data: 'jenis',
          name: 'jenis',
          className: "text-center"
        }, {
          data: 'created_at',
          name: 'created_at',
          className: "text-nowrap"
        }, {
          data: 'nilai',
          name: 'nilai',
          className: "text-center text-bold text-nowrap"
        }, {
          data: 'periode',
          name: 'periode',
          className: "text-center text-nowrap"
        }, {
          data: 'status',
          name: 'status',
          className: "text-center"
        }, {
          data: 'aksi',
          name: 'aksi',
          className: "text-right trigger-icon"
        }, ],

        // columnDefs: [{
        //   orderable: false,
        //   targets: [0, 1, 2, 3, 4, 5, 6]
        // }],
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
          "emptyTable": "Belum ada penilaian",
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
          url: "/penilaian/" + dataId, //eksekusi ajax ke url ini
          type: 'delete',
          beforeSend: function() {
            $('#tombol-hapus').text('Hapus'); //set text untuk tombol hapus
            $('#tombol-hapus').focus(); //set focus
          },
          success: function(data) { //jika sukses
            setTimeout(function() {
              $('#hapus-modal').modal('hide'); //sembunyikan konfirmasi modal
              var oTable = $('#table_pennilaian').dataTable();
              oTable.fnDraw(false); //reset datatable
            });
            iziToast.warning({ //tampilkan izitoast warning
              title: `Ok.`,
              message: `Data penilaian berhasil dihapus`,
              position: `topCenter`
            });
          }
        })
      });
    @endcan

    // Selesaikan NProgress saat AJAX request selesai dan gambar-gambar dalam tabel telah dimuat
    $(document).ajaxComplete(function(event, xhr, settings) {
      const $container = $('#table_pennilaian'); // Gantilah dengan selector tabel Anda
      stopLoadingWhenImagesLoaded($container);
    });

    // akhir script
  </script>
@endsection
