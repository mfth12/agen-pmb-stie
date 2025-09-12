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
        <form enctype="multipart/form-data" action="{{ route('kotaksaran.store') }}" method="POST"
          name="kotaksaran_create">
          @csrf
          <div class="row">
            <div class="col-md-8">
              <div class="card card-secondary">
                <div class="card-body">
                  <div class="form-group">
                    <label for="pengguna_id" class="control-label">Atas Nama</label>
                    {{-- JIKA SUPERADMIN DAN MANAGER --}}
                    @can('akses_superadmin_manager')
                      <select autofocus class="form-control @error('pengguna_id') is-invalid @enderror select2"
                        name="pengguna_id">
                        <option value="{{ old('pengguna_id') }}" @empty(old('pengguna_id')) selected @endempty
                          disabled>-- Pilih
                          Pengguna --</option>
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
                  </div>

                  <div class="form-group">
                    <label for="judul" class="control-label">Judul</label>
                    <input type="text" class="form-control @error('judul') is-invalid @enderror" id="judul"
                      name="judul" value="{{ old('judul') }}" placeholder="Berikan judul untuk saran Anda">
                    @error('judul')
                      <div class="invalid-feedback">
                        *{{ $message }}
                      </div>
                    @enderror
                  </div>

                  <div class="form-group">
                    <label for="kategori" class="control-label">Kategori</label>
                    <select autofocus class="form-control @error('kategori') is-invalid @enderror select2"
                      name="kategori">
                      <option value="saran" selected>Saran</option>
                      <option value="pengaduan">Pengaduan</option>
                    </select>
                    @error('kategori')
                      <div class="invalid-feedback">
                        *{{ $message }}
                      </div>
                    @enderror
                  </div>

                  {{--  --}}
                  <div class="form-row">
                    <div class="col-md-8 col-md-8">
                      <div class="form-group @error('isi') is-invalid @enderror">
                        <label for="isi" class="control-label">Isi</label>
                        <textarea class="form-control" name="isi" id="isi" value="{{ old('isi') }}" rows="4"
                          placeholder="Deskripsikan isi saran/pengaduan Anda"></textarea>
                      </div>
                      @error('isi')
                        <div class="invalid-feedback">
                          *{{ $message }}
                        </div>
                      @enderror
                    </div>
                    <div class="col-md-4 col-md-4">
                      <div class="form-group">
                        <div>
                          <label for="lampiran" class="form-label">Gambar </label> (Opsional)
                          <img class="img-lihat img-fluid mb-3">
                          <a class="btn btn-md btn-outline-secondary mb-2"
                            style="display:block; border: 1px solid #ced4da;"
                            onclick="document.getElementById('lampiran').click()">Unggah
                            <i class="fa-solid fa-circle-arrow-up ml-1"></i></a>
                          <input class="form-control" type="file" id="lampiran" name="lampiran" style="display: none"
                            onchange="lihatGambar()">
                        </div>
                        @error('lampiran')
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
                          <label class="form-check-label">Catatan: Formulir ini akan ditujukan kepada
                            <a href="javascript:void(0)">Bag. Kepegawaian</a> dan
                            <a href="javascript:void(0)">Developer Sistem</a>.
                          </label>
                        </small>
                      </div>
                    </div>
                  </div>

                </div>
                <div class="card-footer">
                  <a href="{{ url()->previous() }}" class="btn btn-default">Batal</a>
                  <button type="submit" id="tombol-simpan" class="btn btn-primary float-right">Kirim
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
  <link rel="stylesheet" href="{{ asset('css/back/select2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css/back/select2-bootstrap4.min.css') }}">
@endsection

@section('style')
  {{-- kosong --}}
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
      const gambar = document.querySelector('#lampiran');
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
      $("form[name='kotaksaran_create']").validate({
        // Specify validation rules
        rules: {
          pengguna_id: {
            required: true,
            angka: true
          },
          judul: {
            required: true,
            minlength: 2,
          },
          kategori: {
            required: true,
          },
          isi: {
            required: true,
            minlength: 6,
          },
          lampiran: {},
        },
        // Specify validation error messages
        messages: {
          pengguna_id: {
            required: "Formulir harus atas nama salah satu pengguna.",
          },
          judul: {
            required: "Judul harus diisi.",
            minlength: "Judul minimal {0} karakter."
          },
          kategori: {
            required: "Kategori harus dipilih.",
          },
          isi: {
            required: "Alasan harus diisi.",
            minlength: "Deskripsi minimal {0} karakter."
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
          } else {
            error.insertAfter(element);
          }
        },
        submitHandler: function(form) {
          // tombol menyimpan data
          var actionType = $('#tombol-simpan').val();
          $('#tombol-simpan').html('Mengirim..');

          console.log("valid >> " + form.isValid());
          form.submit();
        }
      });
    });
  </script>
@endsection
