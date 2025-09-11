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
    @php
      use App\Models\UnitKerja;
      $kosong = '<i>(Tidak ada data)</i>';
    @endphp

    <section class="content">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="card card-default">
              <div class="card-body">
                <table>
                  <tr>
                    <td style="width: 1%; vertical-align: top;" rowspan="3">
                      <img src="/storage/{{ $unitkerja->ketuaunit->detail->foto }}" class="table-avatar mt-1 mr-2"
                        style="width:50px">
                    </td>
                    <td style="width: 8%; vertical-align: top;">Nama Atasan</td>
                    <td style="width: 1%; vertical-align: top;">:</td>
                    <td style="width: 25%; vertical-align: top;">
                      <a href="/pengguna/{{ $unitkerja->ketuaunit->user_id }}"
                        class="text-dark text-bold">{{ $unitkerja->ketuaunit->nama }}</a>
                    </td>
                  </tr>
                  <tr>
                    <td style="width: 8%; vertical-align: top;">NPPY</td>
                    <td style="width: 1%; vertical-align: top;">:</td>
                    <td style="width: 25%; vertical-align: top;">{{ $unitkerja->ketuaunit->nomer_induk }}</td>
                    <!-- Ganti dengan data NPPY -->
                  </tr>
                  <tr>
                    <td style="width: 8%; vertical-align: top;">Jabatan</td>
                    <td style="width: 1%; vertical-align: top;">:</td>
                    <td style="width: 25%; vertical-align: top;">
                      {{ $unitkerja->titel_unit . ' ' . $unitkerja->nama_unit }} ({{ $unitkerja->singkatan }})
                    </td>
                    <!-- Ganti dengan data Jabatan -->
                  </tr>
                </table>

              </div>
            </div>
          </div>

          <div class="col-md-12">
            <div class="card card-default">
              <div class="card-body">
                @can('akses_superadmin_manager')
                  <div class="d-flex justify-content-lg-start">
                    <div class="form-group mr-2">
                      <a href="{{ route('unitkerja.index') }}" class="btn btn-default">
                        <i class="fas fa-chevron-left mr-1"></i>Kembali
                      </a>
                    </div>
                    <div>
                      <a href="javascript:void(0)" class="btn btn-primary mb-3 mr-2" id="tombol-tambah">Tambah Anggota
                        <i class="fa-solid fa-user-group ml-1"></i></a>
                    </div>
                  @endcan
                </div>
                <div style="overflow-x: auto;">
                  <table id="table_unit_kerja" class="table table-hover">
                    <thead>
                      <tr>
                        <th style="width: 1px">No.</th>
                        <th style="width: 1px">NPPY</th>
                        <th style="width: 1px">Foto</th>
                        <th>Nama</th>
                        <th>Posisi</th>
                        <th>Jabatan</th>
                        <th>Golongan</th>
                        <th class="text-center">Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      @php $n = 0; @endphp
                      @foreach ($pengguna as $unit)
                        @php $n++; @endphp
                        <tr>
                          <td>{{ $n }}</td>
                          <td>{{ $unit->nomer_induk }}</td>
                          <td><img class="table-avatar" src="/storage/{{ $unit->detail->foto }}"></td>
                          <td><a href="/pengguna/{{ $unit->user_id }}"
                              class="text-dark text-nowrap text-bold">{{ $unit->nama }}</a>
                          </td>
                          <td class="text-nowrap">{!! $unit->posisi ? $unit->posisi : $kosong !!}</td>
                          <td class="text-nowrap">{!! $unit->jabatan ? $unit->jabatan : $kosong !!}</td>
                          <td class="text-nowrap">{!! $unit->golongan ? $unit->golongan : $kosong !!}</td>
                          <td class="text-nowrap text-center"><button type="button" name="delete"
                              id="{{ $unit->user_id }}" class="delete btn btn-outline-danger btn-sm"><i
                                class="fas fa-circle-minus mr-1"></i>Lepaskan</button>
                          </td>
                        </tr>
                      @endforeach
                    </tbody>
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
  <link rel="stylesheet" href="{{ asset('css/back/select2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css/back/select2-bootstrap4.min.css') }}">
@endsection

@section('style')
  <style>
    .table-avatar img,
    img.table-avatar {
      border-radius: 50%;
      display: inline;
      width: 1.8rem;
    }
  </style>
@endsection

@section('js_bawah')
  <script src="{{ asset('js/back/jquery.inputmask.min.js') }}"></script>
  <script src="{{ asset('js/back/select2.full.min.js') }}"></script>

  {{-- MULAI MODAL FORM TAMBAH DARI JADWAL PENGGUNA --}}
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
                <input type="hidden" value="{{ $unitkerja->unitkerja_id }}" name="unitkerja_id" id="unitkerja_id">
                {{--  --}}
                <div class="form-group">
                  <label for="pengguna_id" control-label">Nama Pengguna</label>
                  <select class="form-control select2" name="pengguna_id">
                    <option value="" selected="selected">--Pilih--</option>
                    @foreach ($available_pengguna as $available)
                      <option value="{{ $available->user_id }}">{{ $available->nama }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="col mt-2">
                <button type="submit" class="btn btn-primary btn-block" id="tombol-simpan" value="create">Tambah Anggota
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  {{-- MULAI MODAL KONFIRMASI LEPAS --}}
  <div id="lepaskan-modal" class="modal fade shadow-md" tabindex="-1" role="dialog" data-backdrop="static">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Konfirmasi</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Anda yakin ingin melepas anggota ini dari <b>{{ $unitkerja->nama_unit }}</b>?</p>
        </div>
        <div class="modal-footer bg-whitesmoke">
          <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
          <button type="button" class="btn btn-danger" name="tombol-lepaskan" id="tombol-lepaskan">Lepaskan</button>
        </div>
      </div>
    </div>
  </div>

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
      $('#jadwal_id').val(''); //valuenya menjadi kosong
      $('.is-invalid').removeClass('is-invalid'); // Menghapus kelas is-invalid pada elemen input jika valid
      $('.invalid-feedback').remove(); // Menghapus kelas is-invalid pada elemen input jika valid
      $('.select2').val(null).trigger("change");
      $('#form-tambah-edit').trigger("reset"); //mereset semua input dll didalamnya
      $('#modal-judul').html("Tambah Anggota Unit Kerja"); //valuenya tambah pegawai baru
      $('#tambah-edit-modal').modal('show'); //modal tampil
      $('#tombol-simpan').html('Tambah Anggota'); //ubah teks tombol
    });

    //MULAI DATATABLE
    //script untuk memanggil data json dari server dan menampilkannya berupa datatable
    $(document).ready(function() {
      $('#table_unit_kerja').DataTable({
        info: true,
        autoWidth: true, //mengatur lebar width pada table otomatis
        lengthChange: true, //apakah jumlah row statik atau bisa berubah
        lengthMenu: [
          [10, 20, -1],
          [10, 20, "Semua"]
        ], //jumlah data yang ditampilkan
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
          "emptyTable": "Tidak ada anggota unit.",
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

    //SIMPAN & UPDATE DATA DAN VALIDASI (SISI CLIENT)
    //jika jadwal_id = form-tambah-edit panjangnya lebih dari 0 atau bisa dibilang terdapat data dalam form tersebut maka
    //jalankan jquery validator terhadap setiap inputan dll dan eksekusi script ajax untuk simpan data
    if ($("#form-tambah-edit").length > 0) {
      $("#form-tambah-edit").validate({
        errorElement: 'div', // Menggunakan elemen div untuk menampilkan pesan error
        errorClass: 'invalid-feedback col-sm-12', // Kelas yang digunakan untuk menampilkan pesan error
        errorPlacement: function(error, element) {
          // error.insertAfter(element); // Menempatkan pesan error di bawah elemen input
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
          unitkerja_id: {
            required: true,
          },
        },
        messages: {
          pengguna_id: {
            required: "Pengguna harus dipilih.",
          },
          unitkerja_id: {
            required: "Unit kerja harus ada.",
          },
        },
        submitHandler: function(form) {
          var actionType = $('#tombol-simpan').val();
          $('#tombol-simpan').html('Menyimpan data..');

          $.ajax({
            //function yang dipakai agar value pada form-control seperti input, textarea, select dll dapat digunakan pada URL query string ketika melakukan ajax request
            data: $('#form-tambah-edit').serialize(),
            url: "{{ route('unitkerja.store') }}", //url simpan data
            type: "POST", //karena simpan kita pakai method POST
            dataType: 'json', //data tipe kita kirim berupa JSON
            success: function(data) { //jika berhasil 
              $('#form-tambah-edit').trigger("reset"); //form reset
              $('#tambah-edit-modal').modal('hide'); //modal hide
              $('#tombol-simpan').html('Tambah Anggota'); //tombol simpan
              var oTable = $('#table_jadwal_pengguna').dataTable(); //inialisasi datatable
              oTable.fnDraw(false); //reset datatable
              iziToast
                .success({ //tampilkan iziToast dengan notif data berhasil disimpan pada posisi kanan bawah
                  title: `Ok.`,
                  message: `Anggota berhasil ditambahkan`,
                  position: `topCenter`,
                  timeout: 2000
                });
              setTimeout(function() {
                location.reload(); //refresh halaman
                $(document).trigger('reload'); // memicu event reload
              }, 2000);
            },
            error: function(data) { //jika error tampilkan error pada console
              console.log('Error:', data);
              $('#tombol-simpan').html('Gagal menyimpan');
              iziToast
                .error({ //tampilkan iziToast dengan notif data berhasil disimpan pada posisi kanan bawah
                  title: `Gagal.`,
                  message: `Terjadi kesalahan`,
                  position: `topCenter`
                });
            }
          });
        }
      })
    };

    //jika klik class delete (yang ada pada tombol delete) maka tampilkan modal konfirmasi hapus maka
    $(document).on('click', '.delete', function() {
      dataId = $(this).attr('id');
      $('#lepaskan-modal').modal('show');
    });
    //jika tombol hapus pada modal konfirmasi di klik maka
    $('#tombol-lepaskan').click(function() {
      $.ajax({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: "/unitkerja/remove/" + dataId, //eksekusi ajax ke url ini
        type: 'delete',
        beforeSend: function() {
          $('#tombol-lepaskan').text('Melepas..'); //set text untuk tombol hapus
          $('#tombol-lepaskan').focus(); //set focus
        },
        success: function(data) { //jika sukses
          setTimeout(function() {
            $('#lepaskan-modal').modal('hide'); //sembunyikan konfirmasi modal
          }, 300);
          iziToast.warning({ //tampilkan izitoast warning
            title: `Ok.`,
            message: `Anggota berhasil dilepaskan`,
            position: `topCenter`,
            timeout: 1400
          });
          console.log(dataId);
          console.log(data);
          setTimeout(function() {
            location.reload(); //refresh halaman
            $(document).trigger('reload'); // memicu event reload
          }, 1400);
        }
      })
    });
  </script>
@endsection
