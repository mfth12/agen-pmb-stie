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
              Data ini merupakan seluruh pegawai yang memiliki hak akses ke dalam sistem.
            </div>
          </div>
          <div class="col-lg-12">
            <div class="card">
              <div class="card-body">
                <div class="d-flex justify-content-lg-start">
                  <div class="form-group mr-2">
                    <a href="/pengguna/create" class="btn btn-default">Tambah<i class="fa-solid fa-user-plus ml-1"></i>
                    </a>
                  </div>
                </div>
                <table id="table_pengguna" class="table table-hover">
                  <thead>
                    <tr>
                      <th style="width: 1%">No</th>
                      <th class="text-center text-nowrap">No induk</th>
                      <th class="text-center text-nowrap" style="width: 1%">Foto</th>
                      <th class="text-nowrap">Nama Lengkap</th>
                      <th class="text-center text-nowrap">Email</th>
                      <th class="text-center text-nowrap">Role</th>
                      <th class="text-center text-nowrap">WhatsApp</th>
                      <th class="text-center text-nowrap">Status</th>
                      <th style="width: 1%" class="text-center">Aksi</th>
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
  {{-- kosong --}}
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
  {{-- <script src="/js/part_js/tabel_pengguna.js"></script> --}}
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

    //TOMBOL TAMBAH DATA
    //jika tombol-tambah diklik maka
    $('#tombol-tambah').click(function() {
      $('#button-simpan').val("create-post"); //valuenya menjadi create-post
      $('#id').val(''); //valuenya menjadi kosong
      $('#form-tambah-edit').trigger("reset"); //mereset semua input dll didalamnya
      $('#modal-judul').html("Tambah Berita Baru"); //valuenya tambah pegawai baru
      $('#tambah-edit-modal').modal('show'); //modal tampil
    });

    //MULAI DATATABLE
    //script untuk memanggil data json dari server dan menampilkannya berupa datatable
    $(document).ready(function() {
      $('#table_pengguna').DataTable({
        info: true,
        // autoWidth: true, //mengatur lebar width pada table otomatis
        scrollX: true,
        lengthChange: true, //apakah jumlah row statik atau bisa berubah
        ordering: false,
        lengthMenu: [
          [20, 50, 100, -1],
          [20, 50, 100, "Semua"]
        ], //jumlah data yang ditampilkan
        processing: true,
        deferRender: true,
        serverSide: true, //aktifkan server-side
        ajax: {
          url: "{{ route('pengguna.index') }}",
          type: 'GET'
        },
        search: {
          "regex": true
        },
        columns: [{
          data: null,
          sortable: true,
          render: function(data, type, row, meta) {
            return meta.row + meta.settings._iDisplayStart + 1;
          }
        }, {
          data: 'nomer_induk',
          name: 'nomer_induk',
          className: "text-center"
        }, {
          data: 'foto',
          name: 'foto',
          className: "text-center"
        }, {
          data: 'nama',
          name: 'nama',
          className: "trigger-icon"
        }, {
          data: 'email',
          name: 'email',
          className: "text-left text-nowrap"
        }, {
          data: 'role',
          name: 'role',
          className: "text-center text-nowrap"
        }, {
          data: 'nomer_wa',
          name: 'nomer_wa',
          className: "text-center text-nowrap"
        }, {
          data: 'status',
          name: 'status',
          className: "text-center text-nowrap"

        }, {
          data: 'aksi',
          name: 'aksi',
          className: "text-center text-nowrap"
        }, ],

        columnDefs: [{
          orderable: false,
          targets: [1, 2, 4, 5, 6, 7, 8]
        }],
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
        url: "pengguna/hapus/" + dataId, //eksekusi ajax ke url ini
        type: 'delete',
        beforeSend: function() {
          $('#tombol-hapus').text('Hapus'); //set text untuk tombol hapus
          $('#tombol-hapus').focus(); //set focus
        },
        success: function(data) { //jika sukses
          setTimeout(function() {
            $('#hapus-modal').modal('hide'); //sembunyikan konfirmasi modal
            var oTable = $('#table_pengguna').dataTable();
            oTable.fnDraw(false); //reset datatable
          });
          iziToast.warning({ //tampilkan izitoast warning
            title: `Ok.`,
            message: `Data berhasil dihapus`,
            position: `topCenter`
          });
        },
        error: function(xhr, status, error) {
          if (xhr.status == 403) {
            iziToast.error({
              title: 'Fatal!',
              message: 'Penghapusan tidak diizinkan sistem',
              position: 'topCenter',
              timeout: 4000,
            });
          } else {
            iziToast.error({
              title: 'Kode ' + (xhr.responseJSON ? xhr.responseJSON.status : 'tidak diketahui'),
              message: xhr.responseJSON ? xhr.responseJSON.message : `Terjadi kesalahan: ${error}`,
              position: 'topCenter',
              timeout: 4000,
            });
          }
        },
      })
    });

    // Selesaikan NProgress saat AJAX request selesai dan gambar-gambar dalam tabel telah dimuat
    $(document).ajaxComplete(function(event, xhr, settings) {
      const $container = $('#tabel1, #tabel2'); // Gantilah dengan selector tabel Anda
      stopLoadingWhenImagesLoaded($container);
    });
  </script>
@endsection
