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
      <div class="container pb-5">
        <div class="row" id="data_row">
          <div class="col-lg-12">
            <div class="callout callout-default">
              List gaji pokok pegawai berdasarkan pangkat/golongan
            </div>

            <div class="card">
              <div class="card-body">
                {{-- Tombol Atas --}}
                <div class="d-flex flex-wrap justify-content-between">
                  <div class="d-flex flex-wrap justify-content-lg-start">
                    <div class="form-group mr-2">
                      @if (request()->routeIs('gaji_pokok.list'))
                        <a href="{{ route('gaji_pokok.index') }}" class="btn btn-default">
                          <i class="fas fa-chevron-left mr-1"></i>Kembali
                        </a>
                      @endif
                    </div>
                  </div>
                </div>
                {{-- tabel --}}
                <div class="table-responsive">
                  <table id="table_gaji_pokok" class="table table-hover table-bordered table-striped">
                    <thead>
                      <tr>
                        <th class="freeze-col sticky-header">MKG.</th>
                        @foreach ($data_list_gaji->unique('pangkat_gol_id') as $golongan)
                          <th class="text-center sticky-header">{{ $golongan->pangkat_gol->nama_pangkat_gol }}</th>
                        @endforeach
                      </tr>
                    </thead>
                    <tbody>
                      @for ($masaKerja = 0; $masaKerja <= $maxMasaKerja; $masaKerja++)
                        <tr>
                          <td class="text-nowrap text-bold freeze-col">{{ $masaKerja }} Thn</td>
                          @foreach ($data_list_gaji->unique('pangkat_gol_id') as $golongan)
                            <td class="text-center text-nowrap">
                              {{ isset($gajiData[$masaKerja][$golongan->pangkat_gol_id])
                                  ? 'Rp ' . number_format($gajiData[$masaKerja][$golongan->pangkat_gol_id], 0, ',', '.')
                                  : '-' }}
                            </td>
                          @endforeach
                        </tr>
                      @endfor
                    </tbody>
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

    .table-responsive {
      overflow-x: auto;
    }

    /* Style untuk freeze kolom pertama */
    .freeze-col {
      position: sticky;
      left: 0;
      background-color: #fff;
      /* Pastikan background tetap terlihat */
      z-index: 1;
      box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
      /* Tambahkan shadow jika diperlukan */
    }

    /* Style untuk sticky header */
    .sticky-header {
      position: sticky;
      top: 0;
      background-color: #fff;
      /* Pastikan header tetap terlihat */
      z-index: 3;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }
  </style>
@endsection

@section('js_bawah')
  <script src="{{ asset('js/back/jquery.inputmask.min.js') }}"></script>
  <script src="{{ asset('js/back/select2.full.min.js') }}"></script>

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
          <form id="form-tambah-edit" name="form-tambah-edit" class="form-horizontal">
            {{-- @csrf --}}
            <div class="row">
              <div class="col-sm-12">
                {{--  --}}
                <input type="hidden" name="unitkerja_id" id="unitkerja_id">
                {{--  --}}
                <div class="form-group">
                  <label for="ketua_id" class="control-label">Kepala Unit</label>
                  <select class="form-control select2" id="ketua_id" name="ketua_id">
                    @empty(old('ketua_id'))
                      <option value="" selected="selected">--Pilih--</option>
                    @endempty
                    @foreach ($pengguna as $list)
                      <option value="{{ $list->user_id }}">{{ $list->nama }}</option>
                    @endforeach
                  </select>
                </div>
                {{--  --}}
                <div class="form-row">
                  <div class="col-md-8 col-xs-8">
                    <div class="form-group">
                      <label for="nama_unit" class="control-label">Nama Unit</label>
                      <input type="text" class="form-control" id="nama_unit" name="nama_unit" value=""
                        placeholder="Nama lengkap unit">
                    </div>
                  </div>
                  <div class="col-md-4 col-xs-4">
                    <div class="form-group">
                      <label for="singkatan" class="control-label">Singkatan</label>
                      <input type="text" class="form-control" id="singkatan" name="singkatan" value=""
                        placeholder="(Contoh: BAAK)">
                    </div>
                  </div>
                </div>
                {{--  --}}
                <div class="form-row">
                  <div class="col-md-12 col-xs-12">
                    <div class="form-group">
                      <label for="titel_unit" class="control-label">Panggilan</label>
                      <input type="text" class="form-control" id="titel_unit" name="titel_unit" value=""
                        placeholder="(Contoh: kepala, ketua, kasi, dll)">
                    </div>
                  </div>
                </div>

                {{--  --}}
                <div class="form-group">
                  <label for="deskripsi_kerja" class="control-label">Deskripsi</label>
                  <textarea class="form-control" name="deskripsi_kerja" id="deskripsi_kerja" rows="4"
                    placeholder="Deskripsi singkat tentang unit kerja"></textarea>
                </div>

                {{--  --}}
                <div class="form-group mb-3">
                  <label for="status" class="control-label">Status</label>
                  <select class="custom-select select2" id="status" name="status">
                    <option selected="selected" value="">--Pilih--</option>
                    <option value="1">Aktif</option>
                    <option value="0">Non-aktif</option>
                  </select>
                </div>
                {{--  --}}
              </div>
              <div class="col mt-2">
                <button type="submit" class="btn btn-primary btn-block" id="tombol-simpan" value="create">Simpan
                </button>
              </div>
            </div>
          </form>
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

    //TOMBOL TAMBAH DATA
    //jika tombol-tambah diklik maka
    $('#tombol-tambah').click(function() {
      $('#tombol-simpan').val("create-post"); //valuenya menjadi create-post
      $('#unitkerja_id').val(''); //valuenya menjadi kosong
      $('.is-invalid').removeClass('is-invalid'); // Menghapus kelas is-invalid pada elemen input jika valid
      $('.invalid-feedback').remove(); // Menghapus kelas is-invalid pada elemen input jika valid
      $('.select2').val(null).trigger("change");
      $('#form-tambah-edit').trigger("reset"); //mereset semua input dll didalamnya
      $('#modal-judul').html("Tambah Unit Kerja Baru"); //valuenya tambah pegawai baru
      $('#tambah-edit-modal').modal('show'); //modal tampil
      $('#tombol-simpan').html('Tambah Unit'); //ubah teks tombol
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
          ketua_id: {
            required: true,
            maxlength: 64,
          },
          nama_unit: {
            required: true,
            maxlength: 255,
            minlength: 2,
          },
          titel_unit: {
            required: true,
            maxlength: 32,
            minlength: 2,
          },
          singkatan: {
            required: true,
            maxlength: 32,
          },
          deskripsi_kerja: {
            required: true,
            maxlength: 255,
            minlength: 2,
          },
          status: {
            required: true
          },
        },
        messages: {
          ketua_id: {
            required: "Kepala unit harus dipilih",
            maxlength: "Kepala unit tidak boleh lebih dari {0} karakter",
          },
          nama_unit: {
            required: "Nama unit harus diisi",
            maxlength: "Nama unit tidak boleh lebih dari {0} karakter",
            minlength: "Nama unit minimal {0} karakter",
          },
          titel_unit: {
            required: "Panggilan kepala unit harus diisi",
            maxlength: "Panggilan maksimal {0} karakter",
            minlength: "Panggilan minimal {0} karakter",
          },
          deskripsi_kerja: {
            required: "Deskripsi harus diisi",
            maxlength: "Deskripsi tidak boleh lebih dari {0} karakter",
            minlength: "Deskripsi minimal {0} karakter",
          },
          status: {
            required: "Status harus dipilih"
          },
        },
        submitHandler: function(form) {
          var actionType = $('#tombol-simpan').val();
          $('#tombol-simpan').html('Menyimpan..');

          $.ajax({
            data: $('#form-tambah-edit')
              .serialize(), //function yang dipakai agar value pada form-control seperti input, textarea, select dll dapat digunakan pada URL query string ketika melakukan ajax request
            url: "{{ route('unitkerja.store_unit') }}", //url simpan data
            type: "POST", //karena simpan kita pakai method POST
            dataType: 'json', //data tipe kita kirim berupa JSON
            success: function(data) { //jika berhasil 
              setTimeout(function() {
                $('#tambah-edit-modal').modal('hide'); //modal hide
                $('#tombol-simpan').html('Tambah Unit'); //tombol simpan
                $('#form-tambah-edit').trigger("reset"); //form reset
              }, 300);
              iziToast
                .success({ //tampilkan iziToast dengan notif data berhasil disimpan pada posisi kanan bawah
                  title: `Ok.`,
                  message: `Unit kerja berhasil disimpan`,
                  position: `topCenter`,
                  timeout: 2100,
                });
              setTimeout(function() {
                location.reload(); //refresh halaman
                $(document).trigger('reload'); // memicu event reload
              }, 2100);

            },
            error: function(data) { //jika error tampilkan error pada console
              console.log('Error:', data);
              $('#tombol-simpan').html('Gagal menambahkan unit');
              iziToast
                .error({ //tampilkan iziToast dengan notif data berhasil disimpan pada posisi kanan bawah
                  title: `Gagal`,
                  message: `Terjadi kesalahan`,
                  position: `topCenter`,
                  timeout: 1800,
                });
            }
          });
        }
      })
    }

    //MULAI DATATABLE
    //script untuk memanggil data json dari server dan menampilkannya berupa datatable
    $(document).ready(function() {
      @if (request()->routeIs('gaji_pokok.filter'))
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

      $('#table_gaji_pokok').DataTable({
        info: true,
        autoWidth: true, //mengatur lebar width pada table otomatis //set to false
        colReorder: true, // Aktifkan ColReorder untuk tabel
        scrollX: true,
        lengthChange: true, //apakah jumlah row statik atau bisa berubah
        lengthMenu: [
          [100, 250, -1],
          [100, 250, "Semua"]
        ], //jumlah data yang ditampilkan
        processing: true,
        deferRender: true,
        search: {
          "regex": true
        },
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
          "emptyTable": "Tidak ada data gaji pokok",
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
    });

    //TOMBOL EDIT DATA PER PEGAWAI DAN TAMPIKAN DATA BERDASARKAN ID PEGAWAI KE MODAL
    //ketika class edit-post yang ada pada tag body di klik maka
    $('body').on('click', '.edit-post', function() {
      var data_id = $(this).data('id');
      $.get('unitkerja/' + data_id + '/edit', function(data) {
        $('#modal-judul').html("Ubah Unit Kerja");
        $('#tombol-simpan').val("edit-post");
        $('.is-invalid').removeClass('is-invalid'); // Menghapus kelas is-invalid pada elemen input jika valid
        $('#tambah-edit-modal').modal('show');
        $('#tombol-simpan').html('Ubah Unit');

        //set value masing-masing id berdasarkan data yg diperoleh dari ajax get request diatas               
        // $('.select2').val(null).trigger("change");
        $('#unitkerja_id').val(data.unitkerja_id);
        $('#ketua_id').val(data.ketua_id).trigger("change");
        $('#titel_unit').val(data.titel_unit);
        $('#nama_unit').val(data.nama_unit);
        $('#singkatan').val(data.singkatan);
        $('#deskripsi_kerja').val(data.deskripsi_kerja);
        $('#status').val(data.status).trigger("change");

        // Selesaikan NProgress saat AJAX request selesai ambil data untuk diedit
        $(document).ajaxComplete(function(event, xhr, settings) {
          const $container = $('#data_row'); // Gantilah dengan selector tabel Anda
          stopLoadingWhenImagesLoaded($container);
        });
      })
    });

    //jika klik class delete (yang ada pada tombol delete) maka tampilkan modal konfirmasi hapus maka
    $(document).on('click', '.delete', function() {
      dataId = $(this).attr('id');
      $('#hapus-modal').modal('show');
    });

    //jika tombol hapus pada modal konfirmasi di klik maka
    $('#tombol-hapus').click(function() {
      $.ajax({
        // _token: token,
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: "unitkerja/" + dataId, //eksekusi ajax ke url ini
        type: 'delete',
        beforeSend: function() {
          $('#tombol-hapus').text('Hapus'); //set text untuk tombol hapus
          $('#tombol-hapus').focus(); //set focus
        },
        success: function(data) { //jika sukses
          setTimeout(function() {
            $('#hapus-modal').modal('hide'); //sembunyikan konfirmasi modal
            // var oTable = $('#table_gaji_pokok').dataTable();
            // oTable.fnDraw(false); //reset datatable
          });
          iziToast.warning({ //tampilkan izitoast warning
            title: `Ok.`,
            message: `Unit berhasil dihapus`,
            position: `topCenter`,
            timeout: 1800,
          });
          setTimeout(function() {
            location.reload(); //refresh halaman
            $(document).trigger('reload'); // memicu event reload
          }, 1800);
        }
      })
    });

    // Selesaikan NProgress saat AJAX request selesai dan gambar-gambar dalam tabel telah dimuat
    $(document).ajaxComplete(function(event, xhr, settings) {
      const $container = $('#table_gaji_pokok'); // Gantilah dengan selector tabel Anda
      stopLoadingWhenImagesLoaded($container);
    });
  </script>
@endsection
