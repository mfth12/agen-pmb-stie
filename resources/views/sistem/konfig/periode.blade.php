@extends('sistem.konfig.index')

@section('konfig')
  <div class="card-body">
    <div class="tab-content">
      <div class="row">
        <div class="col-lg-12 col-md-12">
          <table id="tabel_periode" class="table table-sm table-hover table-bordered table-valign-middle">
            <thead>
              <tr>
                <th style="width: 1%">No.</th>
                <th>Tahun</th>
                <th>Keterangan</th>
                <th>Aksi</th>
              </tr>
            </thead>
          </table>
          <button class="btn btn-primary float-right mt-3" id="tombol-tambah">
            <span id="tombol-text">Tambah<i class="fa-solid fa-plus ml-1"></i></span>
          </button>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('js_atas')
  {{-- KOSONG --}}
@endsection

@section('js_bawah')
  {{-- MODAL TAMBAH/UBAH --}}
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
            @csrf
            <div class="row">
              <div class="col-sm-12">
                <input type="hidden" name="id_periode" id="id_periode">
                <div class="form-row">
                  <div class="col-md-12 col-xs-12">
                    <label for="periode">Tahun</label>
                    <div class="form-group">
                      <input type="text" class="form-control" id="periode" name="periode" value=""
                        placeholder="Tahun Periode">
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="periode">Keterangan</label>
                  <textarea class="form-control" name="keterangan" id="keterangan" rows="3"
                    placeholder="Keterangan singkat tentang periode ini"></textarea>
                </div>
              </div>
              <div class="col mt-2">
                <button type="submit" class="btn btn-secondary btn-block" id="tombol-simpan" value="create">Simpan
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  {{-- JAVASCRIPT --}}
  <script>
    //CSRF TOKEN PADA HEADER
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
      $('#tabel_periode').DataTable({
        paging: false,
        ordering: true,
        scrollX: true,
        info: false,
        ordering: false,
        searching: true,
        serverSide: true, //aktifkan server-side 
        ajax: {
          url: "{{ route('konfig.periode_sistem') }}",
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
          data: 'periode',
          name: 'periode'
        }, {
          data: 'keterangan',
          name: 'keterangan',
          className: "text-left text-nowrap",
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
          "emptyTable": "Tidak ada data periode",
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

    //TOMBOL TAMBAH DATA
    //jika tombol-tambah diklik maka
    $('#tombol-tambah').click(function() {
      $('#tombol-simpan').val("create-post"); //valuenya menjadi create-post
      $('#id_periode').val(''); //valuenya menjadi kosong
      $('.is-invalid').removeClass('is-invalid'); //menghapus kelas is-invalid
      $('.invalid-feedback').remove(); //menghapus kelas invalid-feedback

      $('#form-tambah-edit').trigger("reset"); //mereset semua input dalam form
      $('#modal-judul').html("Tambah Periode"); //judul
      $('#tambah-edit-modal').modal('show'); //modal tampil
      $('#tombol-simpan').html('Tambah'); //ubah teks tombol
    });

    //SIMPAN & UPDATE DATA DAN VALIDASI (SISI CLIENT)
    //jika form-tambah-edit terdapat data dalam form tersebut maka
    //jalankan jquery validator dan eksekusi script ajax untuk simpan data
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
        rules: { //peraturan
          periode: {
            required: true,
            maxlength: 9,
          },
          keterangan: {
            required: true,
            maxlength: 255,
            minlength: 2,
          },
        },
        messages: { //pesan kustom
          periode: {
            required: "Periode harus ada.",
            maxlength: "Periode maksimal {0} karakter.",
          },
          keterangan: {
            required: "Keterangan harus diisi.",
            maxlength: "Keterangan maksimal {0} karakter.",
            minlength: "Keterangan minimal {0} karakter.",
          },
        },
        submitHandler: function(form) {
          //menjalankan perintah ini ketika submit
          var actionType = $('#tombol-simpan').val();
          $('#tombol-simpan').html('Menyimpan..');
          //menjalankan ajax
          $.ajax({
            data: $('#form-tambah-edit')
              .serialize(), //function yang dipakai agar value pada form-control seperti input, textarea, select dll dapat digunakan pada URL query string ketika melakukan ajax request
            url: "{{ route('konfig.store_periode') }}", //url simpan data
            type: "POST", //karena simpan kita pakai method POST
            dataType: 'json', //data tipe kita kirim berupa JSON
            success: function(data) { //jika berhasil lakukan ini
              setTimeout(function() {
                $('#tambah-edit-modal').modal('hide'); //modal hide
                $('#form-tambah-edit').trigger("reset"); //form reset
              }, 400);
              var oTable = $('#tabel_periode').dataTable();
              oTable.fnDraw(false); //reset datatable
              iziToast
                .success({ //tampilkan iziToast
                  title: `Ok.`,
                  message: `Periode berhasil disimpan`,
                  position: `topCenter`,
                  timeout: 2000,
                });
            },
            error: function(data) { //jikak eror, lakukan ini
              $('#tombol-simpan').html('Gagal menyimpan');
              if (data.responseJSON.errors) { //apakah 'errors.periode' tersedia dalam respons
                // console.log('Error0:', data.responseJSON.errors);
                iziToast.error({
                  title: `Gagal`,
                  message: data.responseJSON.errors.periode[0],
                  position: `topCenter`,
                  timeout: 2000,
                });
              } else if (data.responseJSON.exception) { //apakah ada 'exception' database
                // console.log('Error1:', data);
                iziToast.error({
                  title: `Gagal`,
                  message: `Database menolak data`,
                  position: `topCenter`,
                  timeout: 2000,
                });
              } else { //kesalahan yang lainnya
                // console.log('Error2:', data);
                iziToast.error({
                  title: `Gagal`,
                  message: `Terjadi kesalahan`,
                  position: `topCenter`,
                  timeout: 2000,
                });
              }
            }
          });
        }
      })
    }

    //TOMBOL EDIT DAN MENGIRIM DATA KE MODAL
    //ketika class ubah-periode yang ada pada tag body di klik maka
    $('body').on('click', '.ubah-periode', function() {
      var data_id = $(this).data('id');
      //console.log(data_id);
      $.get('periode/' + data_id + '/ubahperiode', function(data) {
        $('#modal-judul').html("Ubah Periode " + data.periode); //judul modal
        $('#tombol-simpan').val("edit-post"); //valuenya jadi edit-post
        $('.is-invalid').removeClass('is-invalid'); //menghapus kelas is-invalid pada elemen input jika valid
        $('#tambah-edit-modal').modal('show'); //menampilkan modal
        $('#tombol-simpan').html('Ubah'); //mengubah tombol simpan

        //set value pada modal berdasarkan data yg diperoleh dari ajax get diatas              
        $('#id_periode').val(data.id_periode);
        $('#periode').val(data.periode);
        $('#keterangan').val(data.keterangan);
        $('#status').val(data.status).trigger("change");
      })
    });

    //jika diklik class delete (yang ada pada tombol delete) maka panggil modal konfirmasi hapus
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
        url: "delete_periode/" + dataId, //eksekusi ajax ke url ini
        type: 'delete',
        beforeSend: function() {
          $('#tombol-hapus').text('Hapus'); //set text untuk tombol hapus
          $('#tombol-hapus').focus(); //set focus
        },
        success: function(data) { //jika sukses lakukan ini
          setTimeout(function() {
            $('#hapus-modal').modal('hide'); //sembunyikan konfirmasi modal
            var oTable = $('#tabel_periode').dataTable();
            oTable.fnDraw(false); //reset datatable
          });
          iziToast.warning({ //tampilkan izitoast
            title: `Ok.`,
            message: `Periode berhasil dihapus`,
            position: `topCenter`,
            timeout: 2000,
          });
        },
        error: function(data) { //jikak eror, lakukan ini
          console.log('ThisIsError:', data);
          iziToast.error({
            title: `Gagal`,
            message: `Terjadi kesalahan dalam menghapus`,
            position: `topCenter`,
            timeout: 2000,
          });
        }
      })
    });

    //MENGAKTIFKAN PERIODE
    $('body').on('click', '.aktifkeun', function() {
      var dataToActivate = $(this).data('id');
      console.log(dataToActivate);
      //menjalankan ajax
      $.ajax({
        // url: "{{ route('konfig.store_periode_aktif', ['id' => ':id', 'periode_aktif' => 'asd']) }}".replace(':id', dataToActivate), //url simpan data
        url: "{{ route('konfig.store_periode_aktif', ['id' => ':id']) }}".replace(':id', dataToActivate),
        data: {
          periode_aktif: dataToActivate
        },
        type: "POST", //karena simpan kita pakai method POST
        dataType: 'json', //data tipe kita kirim berupa JSON
        success: function(data) { //jika berhasil lakukan ini
          var oTable = $('#tabel_periode').dataTable();
          oTable.fnDraw(false); //reset datatable
          iziToast
            .success({ //tampilkan iziToast
              title: `Ok.`,
              message: `Berhasil mengaktifkan periode`,
              position: `topCenter`,
              timeout: 2000,
            });
        },
        error: function(data) { //jikak eror, lakukan ini
          iziToast.error({
            title: `Gagal`,
            message: `Terjadi kesalahan saat aktivasi`,
            position: `topCenter`,
            timeout: 2000,
          });
        }
      });
    });

    // Selesaikan NProgress saat AJAX request selesai dan gambar-gambar dalam tabel telah dimuat
    $(document).ajaxComplete(function(event, xhr, settings) {
      const $container = $('#tabel_periode'); // Gantilah dengan selector tabel Anda
      stopLoadingWhenImagesLoaded($container);
    });
  </script>
@endsection
