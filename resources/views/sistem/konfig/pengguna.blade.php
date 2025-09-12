@extends('sistem.konfig.index')

@section('konfig')
  <div class="card-body">
    <div class="tab-content">
      <div>
        <div class="row">
          <div class="col-lg-12 col-md-12">
            <table id="tabel_roles" class="table table-sm table-hover table-bordered table-valign-middle">
              <thead>
                <tr>
                  <th style="width: 1%">No.</th>
                  <th>Role</th>
                  <th>Keterangan</th>
                  <th>Aksi</th>
                </tr>
              </thead>
            </table>
            <button class="btn btn-primary float-right mt-3" onclick="dev()" id="tombol-tambah">
              <span id="tombol-text">Tambah<i class="fa-solid fa-plus ml-1"></i></span>
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('js_atas')
  {{-- kosong --}}
@endsection

@section('js_bawah')
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

    //MULAI DATATABLE
    //script untuk memanggil data json dari server dan menampilkannya berupa datatable
    $(document).ready(function() {
      $('#tabel_roles').DataTable({
        paging: false,
        ordering: false,
        scrollX: true,
        info: false,
        ordering: false,
        searching: true,
        serverSide: true, //aktifkan server-side 
        ajax: {
          url: "{{ route('konfig.levelpengguna') }}",
          type: 'GET'
        },
        columns: [{
          data: null,
          className: "text-center",
          sortable: false, //harusnya false
          render: function(data, type, row, meta) {
            return meta.row + meta.settings._iDisplayStart + 1;
          }
        }, {
          data: 'nama_role',
          name: 'nama_role'
        }, {
          data: 'keterangan',
          name: 'keterangan',
          className: "text-left text-nowrap"
        }, {
          data: 'aksi',
          name: 'aksi',
          className: "text-center"
        }, ],
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

    // Selesaikan NProgress saat AJAX request selesai dan gambar-gambar dalam tabel telah dimuat
    $(document).ajaxComplete(function(event, xhr, settings) {
      const $container = $('#tabel1, #tabel2'); // Gantilah dengan selector tabel Anda
      stopLoadingWhenImagesLoaded($container);
    });
  </script>
@endsection
