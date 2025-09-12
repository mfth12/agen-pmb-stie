@extends('components.theme.back')

@section('container')
  <div class="content-wrapper">
    <section class="content-header">
      <div class="container">
        <div class="row mb-2">
          <div class="col-lg-6">
            {{-- <div class="row "> --}}
            <h1>{{ $head_page }}</h1>
            @if (request()->routeIs('presensi.filter'))
              Periode:
              @if ($mulaiDate->isSameDay($endDate))
                <b>{{ $mulaiDate->translatedFormat('d M Y') }}</b>
              @else
                <b>{{ $mulaiDate->translatedFormat('d F Y') }}</b> sd. <b>{{ $endDate->translatedFormat('d F Y') }}</b>
              @endif
            @endif
            <div>
              <span id="selected-date-range1" class="text-muted text-bold"></span>
              <span id="selected-date-range-divider" class="text-muted"></span>
              <span id="selected-date-range2" class="text-muted text-bold"></span>
            </div>
            <h5 id="selected-date-range" class="text-muted"></h5>
            {{-- </div> --}}
          </div>

          <div class="col-lg-6">
            <ol class="breadcrumb float-sm-right">
              {{ Breadcrumbs::render() }}
            </ol>
          </div>
        </div>
      </div>
    </section>


    @if (request()->routeIs('presensi.index'))
      <section class="content">
        <div class="container">
          <div class="row mb-2">
            <div class="col-sm-6 col-md-3 col-6">
              <a href="{{ route('presensi.harian') }}">
                <div class="info-box" style="margin-bottom: 0.5rem; color: black">
                  <span class="info-box-icon bg-primary"><i class="fas fa-fingerprint"></i></span>
                  <div class="info-box-content" style="line-height: 1.3">
                    <span class="info-box-text">Hari Ini</span>
                    <span class="info-box-number counter" data-target="{{ $jml_hari_ini }}">
                      {{ 0 }}%</span>
                    <div class="progress">
                      <div id="progress-bar" class="progress-bar" style="width: 0%; background-color: #0000008a"></div>
                    </div>
                  </div>
                </div>
              </a>
            </div>
            <div class="col-sm-6 col-md-3 col-6">
              <a href="{{ route('presensi.whatsapp') }}">
                <div class="info-box" style="margin-bottom: 0.5rem; color: black">
                  <span class="info-box-icon bg-success"><i class="fab fa-whatsapp"></i></span>
                  <div class="info-box-content" style="line-height: 1.3">
                    <span class="info-box-text">Whatsapp</span>
                    <span class="info-box-number counter" data-target="1271">1271</span>
                  </div>
                </div>
              </a>
            </div>
            <div class="col-sm-6 col-md-3 col-6">
              <a href="{{ route('presensi.logs') }}">
                <div class="info-box" style="margin-bottom: 0.5rem; color: black">
                  <span class="info-box-icon bg-warning"><i class="fas fa-database" style="color:white"></i></span>
                  <div class="info-box-content" style="line-height: 1.3">
                    <span class="info-box-text">Logs</span>
                    <span class="info-box-number counter" data-target="39">39</span>
                  </div>
                </div>
              </a>
            </div>
            <div class="col-sm-6 col-md-3 col-6">
              <a href="{{ route('jadwal.index') }}">
                <div class="info-box" style="margin-bottom: 0.5rem; color: black">
                  <span class="info-box-icon bg-danger"><i class="fas fa-clock"></i></span>
                  <div class="info-box-content" style="line-height: 1.3">
                    <span class="info-box-text">Jadwal</span>
                    <span class="info-box-number counter" data-target="{{ $jml_jadwal }}">
                      {{ floor(45 / 2) }}</span>
                  </div>
                </div>
              </a>
            </div>
            <div class="col-sm-6 col-md-3 col-6">
              <a href="{{ route('presensi.statistik') }}">
                <div class="info-box" style="margin-bottom: 0.5rem; color: black">
                  <span class="info-box-icon bg-purple"><i class="fas fa-chart-simple"></i></span>
                  <div class="info-box-content" style="line-height: 1.3">
                    <span class="info-box-text">Statistik</span>
                    <span class="info-box-number counter" data-target="1271">1271</span>
                  </div>
                </div>
              </a>
            </div>
            <div class="col-sm-6 col-md-3 col-6">
              <a href="{{ route('presensi.pribadi') }}">
                <div class="info-box" style="margin-bottom: 0.5rem; color: black">
                  <span class="info-box-icon bg-secondary"><i class="fas fa-fingerprint"></i></span>
                  <div class="info-box-content" style="line-height: 1.5">
                    <span class="info-box-text">Presensi</span>
                    <span class="info-box-text text-muted" data-toggle="tooltip" data-placement="top"
                      title="Presensi Milik Anda">Milik
                      Anda</span>
                  </div>
                </div>
              </a>
            </div>
          </div>
        </div>
      </section>
    @endif

    {{-- Main content --}}
    <section class="content">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-body">
                {{-- Tombol Atas --}}
                <div class="d-flex flex-wrap justify-content-between">
                  <div class="d-flex flex-wrap justify-content-lg-start">
                    <div class="form-group mr-2">
                      @if (request()->routeIs('presensi.filter'))
                        <a href="{{ route('presensi.index') }}" class="btn btn-default">
                          <i class="fas fa-chevron-left mr-1"></i>Kembali</a>
                      @elseif (request()->routeIs('presensi.index'))
                        <a href="javascript:void(0)" class="btn btn-default" id="tombol-tambah">
                          Buat<i class="fa-solid fa-plus ml-1"></i>
                        </a>
                      @endif
                    </div>
                    <div class="form-group mr-2">
                      <div class="input-group">
                        <button type="button" class="btn btn-default" id="daterange-btn">
                          <i class="fas fa-calendar-days mr-2"></i>Filter tanggal<i class="fas fa-caret-down ml-1"></i>
                        </button>
                        <span id="selected-date-range1"></span>
                      </div>
                    </div>

                    <div class="form-group mr-2">
                      <div class="input-group">
                        <button type="button" class="btn btn-default" id="refreshButton" data-toggle="tooltip"
                          data-placement="top" title="Refresh data">
                          <i class="fa fa-refresh"></i></button>
                      </div>
                    </div>
                  </div>

                  <div class="d-flex justify-content-lg-end">
                    @if (request()->routeIs('presensi.filter'))
                      <div class="form-group ">
                        <div class="input-group">
                          {{-- LAMA --}}

                          {{-- BARU --}}
                          <div class="btn-group float-right ml-2">
                            <div class="input-group-prepend">
                              {{-- <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                Opsi
                              </button> --}}
                              <button type="button" class="btn btn-primary" data-toggle="dropdown"
                                data-toggle="tooltip" data-placement="top" title="Cetak laporan presensi">
                                Cetak<i class="fas fa-print ml-1"></i>
                              </button>
                              <div class="dropdown-menu">
                                <a class="dropdown-item" id="cetakButton" href="javascript:void()"><i
                                    class="fas fa-list mr-2"></i>Cetak List</a>
                                <a class="dropdown-item" href="#"><i
                                    class="fas fa-table-cells-large mr-2"></i>Cetak Compact</a>
                                <a class="dropdown-item" href="#"><i class="far fa-circle mr-2"></i>Cetak
                                  Beragam</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#"><i class="far fa-circle mr-2"></i>Separated
                                  link</a>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    @endif
                  </div>
                </div>

                {{-- tabel --}}
                <table id="table_presensi" class="table table-hover table-valign-middle">
                  <thead>
                    <tr>
                      <th style="width: 1px;">No.</th>
                      {{-- <th style="width: 5%; min-width: 70px;">NPPY</th> --}}
                      <th style="width: 1%;">Foto</th>
                      <th style="min-width: 100px;">Nama</th>
                      <th>Tanggal Presensi</th>
                      <th>Waktu</th>
                      <th>Direkam</th>
                      <th style="min-width: 75px;">Status</th>
                      <th style="max-width: 45px;">Finger</th>
                      <th style="width: 1%;">Aksi</th>
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
  {{-- daterange picker --}}
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
  <script src="{{ asset('js/plugins/sparkline.js') }}"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.1/anime.min.js"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const counters = document.querySelectorAll('.counter');

      counters.forEach(counter => {
        const target = parseInt(counter.getAttribute('data-target'));
        const startValue = Math.floor(target / 2); // Mulai dari 50 angka sebelum nilai target
        const duration = 2500; // Durasi animasi dalam milidetik

        anime({
          targets: counter,
          innerHTML: [startValue, target],
          easing: 'linear',
          duration: duration,
          round: 1, // Membulatkan angka agar tidak ada desimal
        });
      });
    });
  </script>

  {{-- Jika request adalah presensi index --}}
  @if (request()->routeIs(['presensi.index', 'presensi.filter']))
    @can('akses_superadmin_manager')
      {{-- MULAI MODAL FORM TAMBAH/EDIT --}}
      <div class="modal fade" id="tambah-edit-modal" data-backdrop="static" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog ">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="modal-judul"></h5>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
              <form id="form-tambah-edit" name="form-tambah-edit" class="form-horizontal" enctype="multipart/form-data">
                {{-- @csrf --}}
                <div class="row">
                  <div class="col-md-12">
                    {{--  --}}
                    <input type="hidden" name="presensi_valid_id" id="presensi_valid_id">
                    <input type="hidden" name="pengguna_id_update" id="pengguna_id_update">
                    {{--  --}}
                    <div class="form-group">
                      <label for="pengguna_id" class="control-label">Nama Pegawai</label>
                      <div>
                        <select class="form-control select2" name="pengguna_id" id="pengguna_id">
                          <option value="" selected="selected">-- Pilih --</option>
                          @foreach ($pengguna as $list)
                            <option value="{{ $list->user_id }}">{{ $list->nama }}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                    {{--  --}}
                    <div class="form-row">
                      <div class="col-md-7 col-xs-7">
                        <div class="form-group">
                          <label for="tanggal_presensi">Tanggal</label>
                          <div class="input-group date" data-target-input="nearest">
                            <input type="text"
                              class="form-control datetimepicker-input @error('tanggal_presensi') is-invalid @enderror"
                              data-target=" #tanggal_presensi" id="tanggal_presensi" name="tanggal_presensi"
                              value="{{ old('tanggal_presensi') }}" placeholder="yyyy-mm-dd" />
                            <div class="input-group-append" data-target="#tanggal_presensi" data-toggle="datetimepicker">
                              <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-5 col-xs-5">
                        <div class="form-group">
                          <label for="jam_presensi">Waktu</label>
                          <div class="input-group date" data-target-input="nearest">
                            <input type="text"
                              class="form-control datetimepicker-input @error('jam_presensi') is-invalid @enderror"
                              data-target="#jam_presensi" id="jam_presensi" name="jam_presensi" placeholder="HH:mm" />
                            <div class="input-group-append" data-target="#jam_presensi" data-toggle="datetimepicker">
                              <div class="input-group-text"><i class="fa fa-clock"></i></div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    {{--  --}}
                    <div class="form-group">
                      <label for="status" class="control-label">Status Presensi</label>
                      <div>
                        <select class="form-control select2" name="status" id="status">
                          <option value="" selected="selected">-- Pilih --</option>
                          <option value="masuk">Masuk</option>
                          <option value="pulang">Pulang</option>
                        </select>
                      </div>
                    </div>
                    {{--  --}}
                    <div class="form-row">
                      <div class="col-sm-12">
                        <div class="form-group">
                          <label for="deskripsi" class="control-label">Deskripsi</label>
                          <div>
                            <textarea class="form-control" name="deskripsi" id="deskripsi" rows="4"
                              placeholder="Deskripsi atau alasan membuat presensi ini"></textarea>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col mt-2">
                    <button type="submit" class="btn btn-primary btn-block" id="tombol-simpan"
                      value="create">Buat</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      {{-- AKHIR MODAL --}}
    @endcan

    @can('akses_superadmin_manager')
      {{-- MULAI MODAL LIHAT PRESENSI --}}
      <div class="modal fade" id="lihat-modal" data-backdrop="static" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="lihat-modal-judul">Lihat Presensi</h5>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
              <form action="#">

                <div class="row">
                  <div class="col-lg-12">

                    <div class="table-responsive">
                      <table class="table table-sm table-borderless">
                        <tr>
                          <td style="width: 40%"><b>Nama Pegawai</b></td>
                          <td>: <span id="nama_pegawai2"></span></td>
                        </tr>
                        <tr>
                          <td style="width: 40%"><b>Tanggal</b></td>
                          <td>: <span id="tanggal_presensi2"></span></td>
                        </tr>
                        <tr>
                          <td style="width: 40%"><b>Waktu</b></td>
                          <td>: <span id="jam_presensi2"></span></td>
                        </tr>
                        <tr>
                          <td style="width: 40%"><b>Status Presensi</b></td>
                          <td>: <span id="status_presensi2"></span></td>
                        </tr>
                        <tr>
                          <td style="width: 40%"><b>Deskripsi</b></td>
                          <td>: <span id="deskripsi2"></span></td>
                        </tr>
                        <tr>
                          <td style="width: 40%"><b>Notif Whatsapp</b></td>
                          <td>: <span id="whatsapp2"></span></td>
                        </tr>
                      </table>
                    </div>
                  </div>
                  <div class="col mt-2">
                    <button type="button" class="btn btn-secondary btn-block" data-dismiss="modal">Tutup</button>
                  </div>
                </div>
              </form>

            </div>
          </div>
        </div>
      </div>
      {{-- AKHIR MODAL --}}
    @endcan
  @endif


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
    //Date range picker
    $('#tanggal_presensi').datetimepicker({
      // format: 'YYYY-MM-DD hh:mm:ss',
      format: 'YYYY-MM-DD', // Format tanggal yang diinginkan
      useCurrent: true // Gunakan tanggal hari ini sebagai nilai awal
    });
    $('#jam_presensi').datetimepicker({
      // format: 'YYYY-MM-DD hh:mm:ss',
      format: 'HH:mm', // Format waktu yang diinginkan
      useCurrent: true // Jangan gunakan waktu saat ini sebagai nilai awal
    });

    //TOMBOL TAMBAH PRESENSI
    //jika tombol-tambah diklik maka
    $('#tombol-tambah').click(function() {
      $('#tombol-simpan').val("create-post"); //valuenya menjadi create-post
      $('#pengguna_id').val(''); //valuenya menjadi kosong
      $('#pengguna_id').prop('disabled', false); // 
      $('.select2').val(null).trigger("change");
      $('.is-invalid').removeClass('is-invalid'); // Menghapus kelas is-invalid pada elemen input jika valid
      $('.invalid-feedback').remove(); // Menghapus elemen dengan class invalid-feedback
      $('#form-tambah-edit').trigger("reset"); //mereset semua input dll didalamnya
      $('#modal-judul').html("Presensi Baru"); //valuenya tambah pegawai baru
      $('#tambah-edit-modal').modal('show'); //modal tampil
      $('#tombol-simpan').html('Buat Presensi'); //ubah teks tombol
    });

    $('body').on('click', '.edit-post', function() {
      var data_id = $(this).data('id');
      // console.log(`data-id=` + data_id);
      $.get('/presensi/' + data_id + '/edit', function(data) {
        $('#modal-judul').html("Ubah Presensi");
        $('#tombol-simpan').val("edit-post");
        $('.is-invalid').removeClass('is-invalid'); // Menghapus kelas is-invalid pada elemen input jika valid
        $('.invalid-feedback').remove(); // Menghapus elemen dengan class invalid-feedback
        $('#tambah-edit-modal').modal('show');
        $('#tombol-simpan').html('Ubah Presensi');

        //set value masing-masing id berdasarkan data yg diperoleh dari ajax get request diatas               
        $('.select2').val(null).trigger("change");
        $('#presensi_valid_id').val(data.presensi_valid_id);
        $('#pengguna_id').val(data.user_id).trigger("change");
        $('#pengguna_id').prop('disabled', true);
        $('#pengguna_id_update').val(data.user_id);
        $('#tanggal_presensi').val(data.tanggalPresensi);
        $('#jam_presensi').val(moment(data.waktuPresensi, 'HH:mm:ss')
          .format('HH:mm')); // Format waktu menjadi HH:mm
        $('#status').val(data.status).trigger("change");
        $('#deskripsi').val(data.deskripsi);
      })
    });

    $('body').on('click', '.lihat-post', function() {
      var data_id = $(this).data('id');
      var no_data = 'Data tidak tersedia';
      $.get('/presensi/' + data_id + '/edit', function(data) {
        $('#lihat-modal').modal('show');

        // Set data ke dalam modal
        $('#nama_pegawai2').text(data.pengguna.nama || no_data);
        // $('#tanggal_presensi2').text(data.tanggalPresensi || no_data);
        // Format tanggal dalam Bahasa Indonesia
        var tanggalFormat = data.tanggalPresensi ?
          moment(data.tanggalPresensi).locale('ID').format('ddd, D MMM YYYY') :
          no_data;
        $('#tanggal_presensi2').text(tanggalFormat);

        $('#jam_presensi2').text(moment(data.waktuPresensi, 'HH:mm:ss').format('HH:mm') || no_data);
        // Capitalize the first letter of 'status' value
        var statusFormat = data.status ? data.status.charAt(0).toUpperCase() + data.status.slice(1) : no_data;
        $('#status_presensi2').text(statusFormat);
        $('#deskripsi2').text(data.deskripsi || no_data);
        $('#whatsapp2').text(data.whatsapp || no_data);
      });
    });




    //SIMPAN & UPDATE DATA DAN VALIDASI (SISI CLIENT)
    //jika ketua_id = form-tambah-edit panjangnya lebih dari 0 atau bisa dibilang terdapat data dalam form tersebut maka
    //jalankan jquery validator terhadap setiap inputan dll dan eksekusi script ajax untuk simpan data
    if ($("#form-tambah-edit").length > 0) {
      $("#form-tambah-edit").validate({
        errorElement: 'div', // Menggunakan elemen div untuk menampilkan pesan error
        errorClass: 'invalid-feedback', // Kelas yang digunakan untuk menampilkan pesan error
        errorPlacement: function(error, element) {
          error.insertAfter(element); // Menempatkan pesan error di bawah elemen input
          element.closest('.form-group').append(error);
        },
        highlight: function(element, errorClass, validClass) {
          $(element).addClass('is-invalid'); // Menambahkan kelas is-invalid pada elemen input
        },
        unhighlight: function(element, errorClass, validClass) {
          $(element).removeClass('is-invalid'); // Menghapus kelas is-invalid pada elemen input jika valid
        },
        rules: {
          pengguna_id: {
            required: true,
          },
          tanggal_presensi: {
            required: true,
          },
          jam_presensi: {
            required: true,
          },
          status: {
            required: true
          },
          // ket_finger: {
          //   required: true
          // },
          deskripsi: {
            required: true
          },
        },
        messages: {
          pengguna_id: {
            required: "Pegawai harus dipilih.",
          },
          tanggal_presensi: {
            required: "Tanggal presensi harus diisi.",
          },
          jam_presensi: {
            required: "Jam presensi harus diisi.",
          },
          status: {
            required: "Status harus dipilih."
          },
          // ket_finger: {
          //   required: "Ket_finger harus diisi."
          // },
          deskripsi: {
            required: "Deskripsi presensi harus diisi."
          },
        },
        submitHandler: function(form) {
          var actionType = $('#tombol-simpan').val();
          $('#tombol-simpan').html('Menyimpan..');

          $.ajax({
            data: $('#form-tambah-edit')
              .serialize(), //function yang dipakai agar value pada form-control seperti input, textarea, select dll dapat digunakan pada URL query string ketika melakukan ajax request
            url: "{{ route('presensi.store') }}", //url simpan data
            type: "POST", //karena simpan kita pakai method POST
            dataType: 'json', //data tipe kita kirim berupa JSON
            timeout: 10000, // Set timeout to 10 detik
            success: function(data) { //jika berhasil 
              console.log('data nya:');
              console.log(data);
              setTimeout(function() {
                $('#tambah-edit-modal').modal('hide'); //modal hide
                $('#tombol-simpan').html('Buat Presensi'); //tombol simpan
                $('#form-tambah-edit').trigger("reset"); //form reset
              }, 500);
              //tampilkan iziToast dengan notif data berhasil disimpan pada posisi kanan bawah
              iziToast.success({
                title: `Ok.`,
                message: `Presensi berhasil dibuat`,
                position: `topCenter`,
                timeout: 5000,
              });
              if (data.tipe === 'not_found') {
                setTimeout(function() {
                  iziToast.warning({
                    title: 'Kode ' + 500, //belum fix
                    message: data.message, // Pesan dari API server
                    position: 'topCenter',
                    timeout: 10000,
                  });
                }, 1000); // Delay 1000 milidetik untuk tampil
              } else if (data.tipe === 'queued') {
                setTimeout(function() {
                  if (data.data.message) {
                    iziToast.error({
                      title: 'Galat.',
                      message: data.data.message, // Pesan dari API server
                      position: 'topCenter',
                    });
                  } else if (data.success == true && data.data.data.status == 1) {
                    iziToast.success({
                      title: 'Berhasil.',
                      message: data.data.data.message, // Pesan dari API server
                      position: 'topCenter',
                    });
                  }
                }, 1000); // Delay 1000 milidetik untuk tampil
              }
              setTimeout(function() {
                var oTable = $('#table_presensi').dataTable();
                oTable.fnDraw(false); //reset datatable
                // location.reload(); //refresh halaman
                // $(document).trigger('reload'); // memicu event reload
              }, 1000);
            },
            error: function(xhr, data, status, error) { //jika error tampilkan error pada console
              console.log('Error:', data);
              $('#tombol-simpan').html('Gagal membuat presensi');
              //tampilkan iziToast dengan notif data berhasil disimpan pada posisi kanan bawah
              iziToast.error({
                title: `Kode ` + (xhr.responseJSON ? xhr.responseJSON.status : 'tidak diketahui'),
                message: xhr.responseJSON ? xhr.responseJSON.message : `Terjadi kesalahan: ${error}`,
                position: `topCenter`,
              });
              if (status == 'timeout') {
                setTimeout(function() {
                  iziToast.error({
                    title: 'Timeout',
                    message: 'Permintaan memakan waktu terlalu lama. Silakan coba lagi.',
                    position: 'topCenter',
                  });
                }, 1000); // Delay 1000 milidetik untuk tampil
              }
            }
          });
        }
      })
    }

    //MULAI DATATABLE
    //script untuk memanggil data json dari server dan menampilkannya berupa datatable
    $(document).ready(function() {
      @if (request()->routeIs('presensi.filter'))
        // Menggunakan regex untuk mencocokkan pola URL dan mendapatkan nilai start_date dan end_date
        var currentUrl = window.location.href;
        var startDateRegex = /start_date=(\d{4}-\d{2}-\d{2})/;
        var endDateRegex = /end_date=(\d{4}-\d{2}-\d{2})/;
        var startDateMatches = currentUrl.match(startDateRegex);
        var endDateMatches = currentUrl.match(endDateRegex);

        // Mendapatkan nilai start_date dan end_date
        const ambilStartDate = startDateMatches ? startDateMatches[1] : null;
        const ambilEndDate = endDateMatches ? endDateMatches[1] : null;
        // Fungsi untuk memformat tanggal
        const formatDate = (date, defaultDate) => {
          return date ? moment(date).format('YYYY-MM-DD') : moment(defaultDate).format('YYYY-MM-DD');
        };
        // Menentukan tanggal default
        const defaultStartDate = moment().subtract(6, 'days'); // 7 hari yang lalu
        const defaultEndDate = moment(); // Tanggal hari ini
        // Memformat tanggal
        const formattedStartDate = formatDate(ambilStartDate, defaultStartDate);
        const formattedEndDate = formatDate(ambilEndDate, defaultEndDate);
      @endif

      $('#table_presensi').DataTable({
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
          // url: "{{ route('presensi.index') }}",
          @if (request()->routeIs('presensi.index'))
            url: "{{ route('presensi.index') }}",
          @elseif (request()->routeIs('presensi.filter'))
            url: "{{ route('presensi.filter') }}",
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
            sortable: false,
            className: "text-center text-nowrap",
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
            data: 'tanggalPresensi',
            name: 'tanggalPresensi',
            className: "text-nowrap"
          },
          {
            data: 'waktuPresensi',
            name: 'waktuPresensi',
            className: "text-center text-nowrap"
          },
          {
            data: 'terbaca',
            name: 'terbaca',
            className: "text-center text-nowrap"
          },
          {
            data: 'status',
            name: 'status',
            className: "text-center text-nowrap"
          },
          {
            data: 'finger',
            name: 'finger',
            className: "text-center text-nowrap no-select"
          },
          {
            data: 'aksi',
            name: 'aksi',
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
          "emptyTable": "Tidak ada rekam data presensi",
          "thousands": ".",
          "paginate": {
            "first": "Pertama",
            "last": "Terakhir",
            "next": "Next",
            "previous": "Prev"
          },
        },
        initComplete: function() {
          console.log('Data presensi selesai digenerate.');
        }
      }).buttons().container();

      // Initialize date range picker
      $('#daterange-btn').daterangepicker({
        @if (request()->routeIs('presensi.filter'))
          startDate: formattedStartDate,
          endDate: formattedEndDate,
        @elseif (request()->routeIs('presensi.index'))
          startDate: moment().subtract(6, 'days'),
            endDate: moment(),
        @endif
        locale: {
          format: 'YYYY-MM-DD', // Set the desired date format here
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
        try {
          // Redirect to the new URL with start_date and end_date as query parameters
          var newURL = '{{ route('presensi.filter') }}' +
            '?start_date=' + encodeURIComponent(start.format('YYYY-MM-DD')) +
            '&end_date=' + encodeURIComponent(end.format('YYYY-MM-DD'));
          window.location.href = newURL;
        } catch (error) {
          console.error("Terjadi kesalahan saat memproses filterisasi:", error);
          // Handle the error as needed, e.g., display an alert to the user
          alert("Terjadi kesalahan saat memproses filterisasi. Mohon dicoba kembali.");
        }
      });

      // Script untuk filter dan DataTable tetap seperti sebelumnya
      $('#cetakButton').click(function() {
        try {
          // Cek apakah daterangepicker ada
          var daterangepicker = $('#daterange-btn').data('daterangepicker');
          if (!daterangepicker) {
            throw new Error('DateRangePicker tidak diinisialisasi.');
          }
          // Ambil nilai tanggal dari DateRangePicker
          var startDate = ambilStartDate;
          var endDate = ambilEndDate;
          // Redirect ke URL cetak dengan parameter tanggal
          var printURL = '{{ route('presensi.cetak') }}' +
            '?start_date=' + encodeURIComponent(startDate) +
            '&end_date=' + encodeURIComponent(endDate);
          window.open(printURL, '_blank');
        } catch (error) {
          console.error("Terjadi kesalahan saat memproses pencetakan:", error.message);
          alert("Terjadi kesalahan saat mencoba mencetak. Silakan ulangi.");
        }
      });
    });

    $(document).ready(function() {
      // Fungsi untuk memuat ulang data tabel
      function refreshTable() {
        var table = $('#table_presensi').DataTable();
        table.ajax.reload(null, false); // Reload data tanpa mengubah paging/urutan
        console.log('Melakukan refresh tabel'); // Console log saat refresh dilakukan
        iziToast.info({ // Tampilkan izitoast info
          message: `Tabel direfresh`,
          position: `topCenter`,
          timeout: 3500
        });
      }

      // Interval ID untuk menyimpan interval
      var intervalId;

      // Fungsi untuk memulai interval refresh
      function startInterval() {
        // Hanya jalankan interval jika belum berjalan
        if (!intervalId) {
          var enve = '{{ env('APP_ENV') }}';
          var intervalTime = enve === "production" ? (1 * 60 * 1000) : (10 * 60 *
            1000); // 1 menit untuk production, 10 menit untuk lainnya
          intervalId = setInterval(refreshTable, intervalTime);
          console.log('Interval berjalan.');
        }
      }

      // Fungsi untuk menghentikan interval refresh
      function stopInterval() {
        if (intervalId) {
          clearInterval(intervalId);
          intervalId = null;
          console.log('Interval dihentikan.');
        }
      }

      // Event visibilitychange untuk memulai/menghentikan interval berdasarkan aktivitas tab
      document.addEventListener('visibilitychange', function() {
        if (document.visibilityState === 'visible') {
          console.log('Tab aktif.');
          startInterval(); // Mulai interval jika tab aktif
        } else {
          console.log('Tab tidak aktif.');
          stopInterval(); // Hentikan interval jika tab tidak aktif
        }
      });

      // Jalankan interval saat halaman pertama kali dimuat, jika tab aktif
      if (document.visibilityState === 'visible') {
        startInterval();
      }

      // Event click untuk tombol refresh (jika diperlukan)
      $('#refreshButton').click(function() {
        refreshTable();
      });

      // Hentikan interval saat halaman akan ditutup atau direfresh
      $(window).on('beforeunload', function() {
        stopInterval();
      });
    });


    //jika klik class delete (yang ada pada tombol delete) maka tampilkan modal konfirmasi hapus maka
    $(document).on('click', '.delete', function() {
      dataId = $(this).attr('id');
      // dataId = $(this).data('id');
      $('#hapus-modal').modal('show');
    });

    //jika tombol hapus pada modal konfirmasi di klik maka
    $('#tombol-hapus').click(function() {
      $.ajax({
        // _token: token,
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: "/presensi/" + dataId, //eksekusi ajax ke url ini
        type: 'delete',
        beforeSend: function() {
          $('#tombol-hapus').text('Hapus'); //set text untuk tombol hapus
          $('#tombol-hapus').focus(); //set focus
        },
        success: function(data) { //jika sukses
          setTimeout(function() {
            $('#hapus-modal').modal('hide'); //sembunyikan konfirmasi modal
            var oTable = $('#table_presensi').dataTable();
            oTable.fnDraw(false); //reset datatable
          });
          iziToast.warning({ //tampilkan izitoast warning
            message: `Data presensi berhasil dihapus`,
            position: `topCenter`
          });
        }
      })
    });

    @if (request()->routeIs('presensi.index'))
      $(document).ready(function() {
        // Nilai target progress bar
        const targetValue = {{ $jml_hari_ini }};
        // Elemen progress bar
        const $progressBar = $('#progress-bar');
        // Fungsi untuk memperbarui lebar progress bar
        function updateProgressBar() {
          let width = 0;
          const interval = setInterval(function() {
            if (width >= targetValue) {
              clearInterval(interval);
            } else {
              width++;
              $progressBar.css('width', width + '%');
            }
          }, 20); // Kecepatan animasi
        }

        // Memulai animasi progress bar
        updateProgressBar();
      });
    @endif

    // Selesaikan NProgress saat AJAX request selesai dan gambar-gambar dalam tabel telah dimuat
    $(document).ajaxComplete(function(event, xhr, settings) {
      const $container = $('#table_presensi'); // Gantilah dengan selector tabel Anda
      stopLoadingWhenImagesLoaded($container);
    });
  </script>
@endsection
