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
            <div class="card card-white card-outline">
              <div class="card-body">
                @can('akses_superadmin_manager')
                  <p class="card-text">
                    Data ini adalah <i>feedback</i> berupa pengaduan dan saran dari pengguna sistem. <a
                      href="javascript:void(0)">
                      Pelajari
                      selengkapnya</a>
                  </p>
                @else
                  <p class="card-text">
                    Anda dapat melakukan pengaduan atau mengirimkan saran terkait penggunaan {{ $konfigs->nama_sistem }}
                    ini. <a href="javascript:void(0)">
                      Pelajari
                      selengkapnya</a>
                  </p>
                @endcan
              </div>
            </div>
          </div>
          {{--  --}}
          <div class="col-lg-12">
            <div class="card">
              <div class="card-body">
                <div class="d-flex justify-content-lg-start">
                  <div>
                    <a href="{{ route('kotaksaran.buat') }}" class="btn btn-default mb-3 mr-2">Kirim<i
                        class="fa-solid fa-paper-plane ml-1"></i>
                    </a>
                  </div>
                </div>
                <table id="table_kotaksaran" class="table table-hover">
                  <thead>
                    <tr>
                      <th style="width: 1%">No.</th>
                      <th>Nama</th>
                      <th>Judul</th>
                      <th>Waktu</th>
                      <th>Kategori</th>
                      <th style="width: 30%;min-width: 270px">Isi</th>
                      <th>Status</th>
                      <th>Aksi</th>
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
    .badge-outline-primary {
      text-align: center;
      margin: 0;
      background-color: transparent;
      border: 1px solid;
      border-radius: 1rem;
    }

    .badge-outline-secondary {
      text-align: center;
      margin: 0;
      color: rgb(60, 60, 60);
      background-color: #7a7c7e37;
      border: 1px solid;
      border-radius: 1rem;
    }
  </style>
@endsection

@section('js_bawah')
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
                <input type="hidden" name="jadwal_id" id="jadwal_id">
                {{--  --}}
                <div class="form-group" hidden>
                  <label for="pengguna_id" class="control-label">Nama Pengguna</label>
                  <select class="form-control" name="pengguna_id">
                    <option value="{{ auth()->user()->user_id }}" selected>
                      {{ auth()->user()->nama }}</option>
                  </select>
                </div>
                {{--  --}}
                <div class="form-group">
                  <label for="nama_jadwal" control-label">Nama Jadwal</label>
                  <input type="text" class="form-control" id="nama_jadwal" name="nama_jadwal" value=""
                    placeholder="Nama jadwal">
                </div>
                {{--  --}}
                <div class="form-group">
                  <label for="ket" control-label">Keterangan</label>
                  <textarea class="form-control" name="ket" id="ket" rows="5" placeholder="Deskripsi jadwal"></textarea>
                </div>
                {{--  --}}
                <div class="form-group">
                  <label for="jam_masuk" control-label">Jam masuk</label>
                  <input type="text" class="form-control" id="jam_masuk" name="jam_masuk" value=""
                    placeholder="HH:mm">
                </div>
                {{--  --}}
                <div class="form-group">
                  <label for="jam_pulang" control-label">Jam pulang</label>
                  <input type="text" class="form-control" id="jam_pulang" name="jam_pulang" value=""
                    placeholder="HH:mm">
                </div>
                {{--  --}}
                <div class="input-group mb-3">
                  <label for="shift" class="col-sm-12 control-label" style="padding-left: 0px;">Shift jadwal</label>
                  <div class="input-group-prepend">
                    <label class="input-group-text" for="shift">Tipe</label>
                  </div>
                  <select class="custom-select" id="shift" name="shift">
                    <option selected value="normal">Normal</option>
                    <option value="malam">Malam</option>
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

    //MULAI DATATABLE
    //script untuk memanggil data json dari server dan menampilkannya berupa datatable
    $(document).ready(function() {
      $('#table_kotaksaran').DataTable({
        info: true,
        // autoWidth: true, //mengatur lebar width pada table otomatis
        scrollX: true,
        lengthChange: true, //apakah jumlah row statik atau bisa berubah
        lengthMenu: [
          [10, 20, -1],
          [10, 20, "Semua"]
        ], //jumlah data yang ditampilkan

        processing: true,
        serverSide: true, //aktifkan server-side 
        ajax: {
          url: "{{ route('kotaksaran.index') }}",
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
          className: "text-left text-nowrap"
        }, {
          data: 'judul',
          name: 'judul'
        }, {
          data: 'waktu',
          name: 'waktu',
          className: "text-center"
        }, {
          data: 'kategori',
          name: 'kategori',
          className: "text-center"
        }, {
          data: 'isi',
          name: 'isi',
          className: "text-center"
        }, {
          data: 'status',
          name: 'status',
          className: "text-center"
        }, {
          data: 'aksi',
          name: 'aksi',
          className: "text-right trigger-icon"
        }, ],

        columnDefs: [{
          orderable: false,
          targets: [0, 1, 2, 5, 6]
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
      $('#hapus-modal').modal('show');
    });

    //jika tombol hapus pada modal konfirmasi di klik maka
    $('#tombol-hapus').click(function() {
      $.ajax({
        // _token: token,
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: "/kotaksaran/" + dataId, //eksekusi ajax ke url ini
        type: 'delete',
        beforeSend: function() {
          $('#tombol-hapus').text('Hapus'); //set text untuk tombol hapus
          $('#tombol-hapus').focus(); //set focus
        },
        success: function(data) { //jika sukses
          setTimeout(function() {
            $('#hapus-modal').modal('hide'); //sembunyikan konfirmasi modal
            var oTable = $('#table_kotaksaran').dataTable();
            oTable.fnDraw(false); //reset datatable
          });
          iziToast.warning({ //tampilkan izitoast warning
            title: `Ok.`,
            message: `Data berhasil dihapus`,
            position: `topCenter`
          });
        }
      })
    });

    // Selesaikan NProgress saat AJAX request selesai dan gambar-gambar dalam tabel telah dimuat
    $(document).ajaxComplete(function(event, xhr, settings) {
      const $container = $('#table_kotaksaran'); // Gantilah dengan selector tabel Anda
      stopLoadingWhenImagesLoaded($container);
    });
  </script>
@endsection
