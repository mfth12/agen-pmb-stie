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
        <form enctype="multipart/form-data" action="{{ route('perdinasan.store_form') }}" method="POST"
          name="percutian_create">
          @csrf
          <div class="row">
            <div class="col-md-8">
              <div class="card card-default">
                <div class="card-header">
                  <h3 class="card-title">Formulir</h3>
                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                      <i class="fas fa-minus"></i>
                    </button>
                  </div>
                </div>

                <div class="card-body">
                  {{--  --}}
                  <div class="form-group">
                    <label for="pengguna_id" class="control-label">Nama Pengguna</label>
                    {{-- JIKA SUPERADMIN DAN MANAGER --}}
                    @can('akses_superadmin_manager')
                      <select autofocus class="form-control @error('pengguna_id') is-invalid @enderror select2"
                        name="pengguna_id">
                        <option value="{{ old('pengguna_id') }}" @empty(old('pengguna_id')) selected @endempty
                          disabled>-- Pilih --</option>
                        @foreach ($pengguna as $list)
                          <option value="{{ $list->user_id }}">{{ $list->nama }}</option>
                        @endforeach
                      </select>
                    @else
                      {{-- PENGGUNA BIASA LAINNYA --}}
                      <select autofocus class="form-control @error('pengguna_id') is-invalid @enderror select2"
                        name="pengguna_id">
                        <option value="{{ old('pengguna_id', auth()->user()->user_id) }}" selected>
                          {{ auth()->user()->nama }}</option>
                      </select>
                    @endcan

                    @error('pengguna_id')
                      <div class="invalid-feedback">
                        *{{ $message }}
                      </div>
                    @enderror
                    <input type="hidden" class="form-control datetimepicker-input" id="tanggal_ajuan"
                      name="tanggal_ajuan" value="" />
                  </div>


                  {{--  --}}
                  <div class="form-row">
                    <div class="col-md-6 col-xs-6">
                      <div class="form-group">
                        <label for="tanggal_dinas_awal">Mulai Dinas</label>
                        <div class="input-group date" data-target-input="nearest">
                          <input type="text"
                            class="form-control datetimepicker-input @error('tanggal_dinas_awal') is-invalid @enderror"
                            data-target=" #tanggal_dinas_awal" id="tanggal_dinas_awal" name="tanggal_dinas_awal"
                            value="{{ old('tanggal_dinas_awal') }}" placeholder="yyyy-mm-dd" />
                          <div class="input-group-append" data-target="#tanggal_dinas_awal" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                          </div>
                        </div>
                        @error('tanggal_dinas_awal')
                          <div class="invalid-feedback">
                            *{{ $message }}
                          </div>
                        @enderror
                      </div>
                    </div>
                    <div class="col-md-6 col-xs-6">
                      <div class="form-group">
                        <label for="tanggal_dinas_akhir">Sampai Tanggal</label>
                        <div class="input-group date" data-target-input="nearest">
                          <input type="text"
                            class="form-control datetimepicker-input @error('tanggal_dinas_akhir') is-invalid @enderror"
                            data-target=" #tanggal_dinas_akhir" id="tanggal_dinas_akhir" name="tanggal_dinas_akhir"
                            value="{{ old('tanggal_dinas_akhir') }}" placeholder="yyyy-mm-dd" />
                          <div class="input-group-append" data-target="#tanggal_dinas_akhir" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                          </div>
                        </div>
                        @error('tanggal_dinas_akhir')
                          <div class="invalid-feedback">
                            *{{ $message }}
                          </div>
                        @enderror
                      </div>
                    </div>
                  </div>
                  {{--  --}}

                  <div class="form-group">
                    <label for="berapa_lama" class="control-label">Lama Dinas</label>
                    <input type="text" class="form-control @error('berapa_lama') is-invalid @enderror" id="berapa_lama"
                      name="berapa_lama" value="{{ old('berapa_lama') }}" placeholder="Lama dinas (Misal: 3 hari)">
                    @error('berapa_lama')
                      <div class="invalid-feedback">
                        *{{ $message }}
                      </div>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="kategori_dinas" class="control-label">Kategori Dinas</label>
                    <select class="form-control @error('kategori_dinas') is-invalid @enderror select2"
                      name="kategori_dinas">
                      <option value="{{ old('kategori_dinas') }}" @empty(old('kategori_dinas')) selected @endempty
                        disabled>-- Pilih --</option>
                      @foreach ($kateg_dinas as $item)
                        <option value="{{ $item->kateg_dinas_id }}">{{ $item->jenis_dinas }}</option>
                      @endforeach
                    </select>
                    @error('kategori_dinas')
                      <div class="invalid-feedback">
                        *{{ $message }}
                      </div>
                    @enderror
                  </div>

                  {{--  --}}
                  <div class="form-row">
                    <div class="col-md-7 col-xs-7">
                      <div class="form-group @error('keperluan_dinas') is-invalid @enderror">
                        <label for="keperluan_dinas" class="control-label">Keperluan Tugas</label>
                        <textarea class="form-control" name="keperluan_dinas" id="keperluan_dinas" value="{{ old('keperluan_dinas') }}"
                          rows="4" placeholder="Deskripsikan keperluan tugas dinas"></textarea>
                      </div>
                      @error('keperluan_dinas')
                        <div class="invalid-feedback">
                          *{{ $message }}
                        </div>
                      @enderror
                    </div>
                    <div class="col-md-5 col-xs-5">
                      <div class="form-group">
                        <div>
                          <label for="bukti" class="form-label">Berkas/gambar </label> <small
                            class="text-muted">(Opsional)</small>
                          <img class="img-lihat img-fluid mb-3">
                          <a class="btn btn-md btn-outline-secondary mb-2"
                            style="display:block; border: 1px solid #ced4da;"
                            onclick="document.getElementById('bukti').click()">Unggah
                            <i class="fa-solid fa-circle-arrow-up ml-1"></i></a>
                          <input class="form-control" type="file" id="bukti" name="bukti"
                            style="display: none" onchange="lihatGambar()">
                        </div>
                        @error('bukti')
                          <div class="invalid-feedback">
                            *{{ $message }}
                          </div>
                        @enderror
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="row">
                      <div class="col-sm-12">
                        <small>
                          <label class="form-check-label">Catatan: Formulir pengajuan tugas dinas ini harus disetujui
                            oleh <a href="javascript:void(0)">Wakil Ketua II</a>.</label>
                        </small>
                      </div>
                    </div>
                  </div>

                </div>
                <div class="card-footer">
                  <a href="{{ url()->previous() }}" class="btn btn-default">
                    <i class="fas fa-chevron-left mr-1"></i>Batal</a>
                  <button type="submit" id="tombol-simpan" class="btn btn-info float-right">Kirim
                    <i class="fa-solid fa-paper-plane ml-1"></i></button>
                </div>
              </div>
            </div>

          </div>
        </form>
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
    $('#tanggal_dinas_awal').datetimepicker({
      // format: 'YYYY-MM-DD hh:mm:ss',
      format: 'YYYY-MM-DD',
    });
    $('#tanggal_dinas_akhir').datetimepicker({
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

    jQuery.validator.addMethod("lettersonly", function(value, element) {
      return this.optional(element) || /^[a-zA-Z\s]+$/i.test(value);
      // return this.optional(element) || /^[a-z]+$/i.test(value); //tanpa spasi
      // var regex = new RegExp(/^[a-zA-Z\s]+$/);
    }, "Input hanya berupa huruf.");

    jQuery.validator.addMethod("angka", function(value, element) {
      return this.optional(element) || /^[0-9.]+$/i.test(value);
      // return this.optional(element) || /^[a-z]+$/i.test(value); //tanpa spasi
      // var regex = new RegExp(/^[a-zA-Z\s]+$/);
    }, "Input hanya berupa kombinasi angka dan titik.");

    // validation first form
    // validation first form
    // Wait for the DOM to be ready
    $(function() {
      $("form[name='percutian_create']").validate({
        // Specify validation rules
        rules: {
          pengguna_id: {
            required: true,
            angka: true
          },
          cuti_id: {
            required: true,
          },
          tanggal_ajuan: {},
          tanggal_dinas_awal: {
            required: true,
          },
          tanggal_dinas_akhir: {
            required: true,
          },
          berapa_lama: {
            required: true,
          },
          kategori_dinas: {
            required: true,
          },
          keperluan_dinas: {
            required: true,
            minlength: 6
          },
          bukti: {},
        },
        // Specify validation error messages
        messages: {
          cuti_id: {
            required: "Nomor formulir harus diisi.",
          },
          pengguna_id: {
            required: "Pengguna harus dipilih.",
          },
          tanggal_dinas_awal: {
            required: "Tanggal cuti harus diisi.",
          },
          tanggal_dinas_akhir: {
            required: "Batas tanggal cuti harus diisi.",
          },
          berapa_lama: {
            required: "Durasi harus diisi.",
          },
          kategori_dinas: {
            required: "Kategori dinas harus dipilih.",
          },
          keperluan_dinas: {
            required: "Keperluan cuti harus diisi.",
            minlength: "Deskripsi halaman minimal {0} karakter."
          },
        },
        // bagian yang dihighlight
        highlight: function(element) {
          $(element).closest('.input-group > input').addClass('is-invalid');
          $(element).closest('.form-group > input').addClass('is-invalid');
          $(element).closest('.form-group > select').addClass('is-invalid');
          $(element).closest('.form-group > span').addClass('is-invalid');
          $(element).closest('.form-group > span > span').addClass('is-invalid');
          $(element).closest('.form-group > textarea').addClass('is-invalid');

        },
        unhighlight: function(element) {
          $(element).closest('.input-group > input').removeClass('is-invalid');
          $(element).closest('.form-group > input').removeClass('is-invalid');
          $(element).closest('.form-group > select').removeClass('is-invalid');
          $(element).closest('.form-group > span').removeClass('is-invalid');
          $(element).closest('.form-group > span > span').removeClass('is-invalid');
          $(element).closest('.form-group > textarea').removeClass('is-invalid');

        },
        errorElement: 'div',
        errorClass: 'invalid-feedback',
        errorPlacement: function(error, element) {

          if (element.parent('.input-group').length) {
            error.insertAfter(element.parent());
          } else if (element.parent('.select2-container--default')) {
            error.insertAfter(element);
            element.closest('.form-group').append(error);
          } else {
            error.insertAfter(element);
          }
        },
        submitHandler: function(form) {
          var tanggalIzinAwal = $('#tanggal_dinas_awal').val();
          var tanggalIzinAkhir = $('#tanggal_dinas_akhir').val();

          if (tanggalIzinAwal > tanggalIzinAkhir) {
            iziToast.error({
              title: 'Galat',
              message: 'Periksa kembali tanggal yang Anda atur!',
              position: 'topCenter'
            });
            $('#tanggal_dinas_awal').addClass('is-invalid');
            $('#tanggal_dinas_akhir').addClass('is-invalid');
            return;
          }

          // Menambahkan skrip Anda untuk memperbarui tanggal_ajuan di sini
          var currentTimestamp = new Date().toISOString();
          var updatedTimestamp = new Date(currentTimestamp);
          updatedTimestamp.setHours(updatedTimestamp.getHours() + 7);
          var formattedTimestamp = updatedTimestamp.toISOString().slice(0, 19).replace('T', ' ');
          $('#tanggal_ajuan').val(formattedTimestamp);

          // // tombol menyimpan data
          // var actionType = $('#tombol-simpan').val();
          // $('#tombol-simpan').html('Mengirim..');

          console.log("valid >> " + form.isValid());
          form.submit();
        }
      });
    });


    // // validation second form
    // // validation second form
    // // Wait for the DOM to be ready
    // $(function() {
    //   $("form[name='edit_pengguna']").validate({
    //     rules: {
    //       nama: "required",
    //       cuti_id: {
    //         required: true,
    //         angka: true,
    //         minlength: 6
    //       },
    //       email: {
    //         required: false,
    //         email: true
    //       },
    //       password: {
    //         minlength: 6
    //       },
    //       nisn: {
    //         minlength: 9
    //       },
    //       asal: {
    //         lettersonly: true
    //       },
    //       tempat_lahir: {
    //         lettersonly: true
    //       },

    //     },
    //     // Specify validation error messages
    //     messages: {
    //       cuti_id: {
    //         required: "Nomor induk harus diisi.",
    //         angka: "ID hanya berupa kombinasi angka dan titik.",
    //         minlength: "Nomor induk  minimal {0} karakter."
    //       },
    //       nama: "Nama lengkap harus diisi.",
    //       email: "Email harus berupa alamat yang valid.",
    //       password: {
    //         required: "Password harus diisi.",
    //         minlength: "Password minimal {0} karakter."
    //       },
    //       password_ulang: {
    //         required: "Konfirmasi password harus diisi.",
    //         equalTo: "Password konfirmasi tidak cocok.",
    //         minlength: "Password minimal {0} karakter."
    //       },
    //       nisn: {
    //         minlength: "NISN minimal {0} angka."
    //       },
    //       kelas: "Kelas harus dipilih.",

    //     },
    //     highlight: function(element) {

    //       $(element).closest('.input-group > input').addClass('is-invalid');
    //       $(element).closest('.form-group > input').addClass('is-invalid');
    //       $(element).closest('.form-group > select').addClass('is-invalid');

    //     },
    //     unhighlight: function(element) {

    //       $(element).closest('.input-group > input').removeClass('is-invalid');
    //       $(element).closest('.form-group > input').removeClass('is-invalid');
    //       $(element).closest('.form-group > select').removeClass('is-invalid');

    //     },
    //     errorElement: 'div',
    //     errorClass: 'invalid-feedback',
    //     errorPlacement: function(error, element) {
    //       if (element.parent('.input-group').length) {
    //         error.insertAfter(element.parent());
    //       } else {
    //         error.insertAfter(element);
    //       }
    //     },
    //     submitHandler: function(form) {
    //       console.log("valid >> " + form.isValid());
    //       form.submit();
    //     }
    //   });
    // });

    // $(document).ready(function() {
    //   $('#pengajuan_izin_form').submit(function(event) {
    //     // Mencegah perilaku pengiriman formulir bawaan
    //     event.preventDefault();

    //     // Menambahkan skrip Anda untuk memperbarui tanggal_ajuan di sini
    //     var currentTimestamp = new Date().toISOString();
    //     var updatedTimestamp = new Date(currentTimestamp);
    //     updatedTimestamp.setHours(updatedTimestamp.getHours() + 7);
    //     var formattedTimestamp = updatedTimestamp.toISOString().slice(0, 19).replace('T', ' ');
    //     $('#tanggal_ajuan').val(formattedTimestamp);

    //     // Sekarang mengirimkan formulir secara programatik
    //     this.submit();
    //   });
    // });
  </script>
@endsection
