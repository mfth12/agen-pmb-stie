@extends('components.theme.back')

@section('container')
  <div class="content-wrapper">
    <section class="content-header">
      <div class="container">
        <div class="row mb-2">
          <div class="col-md-6">
            <h1>{{ $head_page }}</h1>
          </div>
          <div class="col-md-6">
            <ol class="breadcrumb float-sm-right">
              {{ Breadcrumbs::render() }}
            </ol>
          </div>
        </div>
      </div>
    </section>

    <section class="content">
      <div class="container">
        {{-- BYPASS membuat ID di mesin fingerprint --}}
        @if (env('STRICT_CREATING_PENGGUNA') == false)
          <div class="row">
            <div class="col-12">
              <div class="alert alert-warning alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <i class="fa-solid fa-exclamation-triangle mr-2"></i><strong>Mode bypass!</strong>
                Pengguna akan dibuat, tapi tidak didaftarkan pada mesin fingerprint. Lakukan pengaturan pada
                <code>.env</code> sistem.
              </div>
            </div>
          </div>
        @endif
        <form enctype="multipart/form-data" action="{{ route('pengguna.store') }}" method="POST" name="daftar_pengguna">
          @csrf
          <div class="row">
            {{-- kolom kiri --}}
            <div class="col-md-7">
              {{-- general form elements --}}
              <div class="card card-default">
                <div class="card-header">
                  <h3 class="card-title">Profil</h3>
                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                      <i class="fas fa-minus"></i>
                    </button>
                  </div>
                </div>
                {{-- /.card-header --}}
                <div class="card-body">
                  <div class="input-group mb-1">
                    <div class="input-group-prepend">
                      <span class="input-group-text">NPPY</span>
                    </div>
                    <input type="text" {{-- onkeypress="return /[0-9.,]/i.test(event.key)" --}}
                      class="form-control @error('nomer_induk') is-invalid @enderror" id="nomer_induk" name="nomer_induk"
                      value="{{ old('nomer_induk') }}" placeholder="Nomor Pokok Pegawai Yayasan" autofocus>
                    @error('nomer_induk')
                      <div class="invalid-feedback">
                        *{{ $message }}
                      </div>
                    @enderror
                  </div>

                  <div class="row">
                    <div class="col-sm-8">
                      <div class="form-group mt-3">
                        <label for="nama">Nama Lengkap</label> (Beserta Gelar)
                        <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama"
                          name="nama" value="{{ old('nama') }}" placeholder="Nama Fulan">
                        @error('nama')
                          <div class="invalid-feedback">
                            *{{ $message }}
                          </div>
                        @enderror
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="form-group mt-3">
                        <label for="panggilan">Panggilan </label>
                        <input type="text" class="form-control @error('panggilan') is-invalid @enderror" id="panggilan"
                          name="panggilan" value="{{ old('panggilan') }}" placeholder="Fulan">

                        @error('panggilan')
                          <div class="invalid-feedback">
                            {{ $message }}
                          </div>
                        @enderror
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                      name="email" value="{{ old('email') }}" placeholder="fulan@gmail.com">
                    @error('email')
                      <div class="invalid-feedback">
                        *{{ $message }}
                      </div>
                    @enderror
                  </div>

                  <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                      name="password" value="{{ old('password') }}"
                      placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;">
                    @error('password')
                      <div class="invalid-feedback">
                        *{{ $message }}
                      </div>
                    @enderror
                  </div>

                  <div class="form-group">
                    <label for="password_ulang">Password Konfirmasi</label>
                    <input type="password" class="form-control @error('password_ulang') is-invalid @enderror"
                      id="password_ulang" name="password_ulang" value=""
                      placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;">
                    @error('password_ulang')
                      <div class="invalid-feedback">
                        *{{ $message }}
                      </div>
                    @enderror
                  </div>

                  <div class="form-group">
                    <div class="row">
                      <div class="col-sm-8">
                        <div class="form-group">
                          <label>Level Pengguna</label>
                          <select class="form-control" name="role">
                            @foreach ($role as $data)
                              <option value="{{ $data->role }}">{{ $data->nama_role }}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <label for="status">&nbsp;</label>
                        <div class="form-group">
                          <div class="custom-control custom-switch float-right">
                            <input type="checkbox" name="status" class="custom-control-input" id="status" checked>
                            <label class="custom-control-label" style="font-weight: 400" for="status">
                              Status Aktif</label>
                          </div>
                          @error('status')
                            <div class="invalid-feedback">
                              *{{ $message }}
                            </div>
                          @enderror
                        </div>
                      </div>
                    </div>
                  </div>

                  {{-- HIDDEN INPUT --}}
                  <input type="hidden" class="form-control @error('uid') is-invalid @enderror" id="uid"
                    name="uid" value="{{ old('uid', $latestUid) }}">
                  @error('uid')
                    <div class="invalid-feedback">
                      *{{ $message }}
                    </div>
                  @enderror

                </div>
                <div class="card-footer">
                  <a href="{{ url()->previous() }}" class="btn btn-default">
                    <i class="fas fa-chevron-left mr-1"></i>Kembali</a>
                  <button type="submit" class="btn btn-primary float-right" id="tombol-tambah">
                    Tambah<i class="fa-solid fa-plus ml-1"></i>
                  </button>
                </div>
              </div>
            </div>

            {{-- kolom kanan --}}
            <div class="col-md-5">
              <div class="card card-default">
                <div class="card-header">
                  <h3 class="card-title">Detail</h3>
                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                      <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                      <i class="fas fa-times"></i>
                    </button>
                  </div>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-sm-4">
                      <label for="foto" class="form-label">Foto Profil</label>
                      <img class="img-lihat img-fluid mb-3">
                      <a class="btn btn-md btn-outline-secondary mb-3" style="display:block; border: 1px solid #ced4da;"
                        onclick="document.getElementById('foto').click()">Unggah
                        <i class="fa-solid fa-circle-arrow-up ml-1"></i></a>
                      <input class="form-control @error('foto') is-invalid @enderror" type="file" id="foto"
                        name="foto" style="display:none" onchange="lihatGambar()">
                      @error('foto')
                        <div class="invalid-feedback">
                          *{{ $message }}
                        </div>
                      @enderror
                    </div>

                    <div class="col-sm-8">
                      <div class="form-group">
                        <label for="nisn">NIDN</label>
                        <input type="number" class="form-control @error('nisn') is-invalid @enderror" id="nisn"
                          name="nisn" value="{{ old('nisn') }}" placeholder="Nomor Induk Dosen Nasional">
                      </div>
                      <div class="form-group">
                        <label for="tempat_lahir">Tempat lahir</label>
                        <input type="text" class="form-control @error('tempat_lahir') is-invalid @enderror"
                          id="tempat_lahir" name="tempat_lahir" value="{{ old('tempat_lahir') }}"
                          placeholder="Kota/daerah">
                      </div>
                      <div class="form-group">
                        <label for="tanggal_lahir">Tanggal lahir</label>
                        <div class="input-group date" data-target-input="nearest">
                          <input type="text"
                            class="form-control datetimepicker-input @error('tanggal_lahir') is-invalid @enderror"
                            data-target=" #tanggal_lahir" id="tanggal_lahir" name="tanggal_lahir"
                            value="{{ old('tanggal_lahir') }}" placeholder="yyyy-mm-dd" />
                          <div class="input-group-append" data-target="#tanggal_lahir" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <textarea class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat"
                          value="{{ old('alamat') }}" rows="3" placeholder="Alamat rumah atau tempat tinggal"></textarea>
                      </div>
                      {{-- end --}}
                    </div>
                  </div>

                  {{-- end --}}
                </div>
              </div>

              <div class="card">

                <div class="card-header">
                  <h3 class="card-title">Orang tua</h3>
                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                      <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                      <i class="fas fa-times"></i>
                    </button>
                  </div>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-sm-7">
                      <div class="form-group">
                        <label for="nama_ayah">Ayah</label>
                        <input type="text" class="form-control @error('nama_ayah') is-invalid @enderror"
                          id="nama_ayah" name="nama_ayah" value="{{ old('nama_ayah') }}" placeholder="Nama Ayah">
                      </div>
                    </div>
                    <div class="col-sm-5">
                      <div class="form-group">
                        <label for="pekerjaan_ayah">Pekerjaan</label>
                        <input type="text" class="form-control @error('pekerjaan_ayah') is-invalid @enderror"
                          id="pekerjaan_ayah" name="pekerjaan_ayah" value="{{ old('pekerjaan_ayah') }}"
                          placeholder="">
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-7">
                      <div class="form-group">
                        <label for="nama_ibu">Ibu</label>
                        <input type="text" class="form-control @error('nama_ibu') is-invalid @enderror"
                          id="nama_ibu" name="nama_ibu" value="{{ old('nama_ibu') }}" placeholder="Nama Ibu">
                      </div>
                    </div>
                    <div class="col-sm-5">
                      <div class="form-group">
                        <label for="pekerjaan_ibu">Pekerjaan</label>
                        <input type="text" class="form-control @error('pekerjaan_ibu') is-invalid @enderror"
                          id="pekerjaan_ibu" name="pekerjaan_ibu" value="{{ old('pekerjaan_ibu') }}" placeholder="">
                      </div>
                    </div>
                  </div>
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
  <link rel="stylesheet" href="/css/back/daterangepicker.css">
  <link rel="stylesheet" href="/css/back/bootstrap-colorpicker.min.css">
  <link rel="stylesheet" href="/css/back/tempusdominus-bootstrap-4.min.css">
  <link rel="stylesheet" href="/css/back/select2.min.css">
  <link rel="stylesheet" href="/css/back/select2-bootstrap4.min.css">
  <link rel="stylesheet" href="/css/back/bootstrap-duallistbox.min.css">
  <link rel="stylesheet" href="/css/back/bs-stepper.min.css">
  <link rel="stylesheet" href="/css/back/dropzone.min.css">
@endsection

@section('js_bawah')
  {{-- <script src="/js/part_js/tabel_pengguna.js"></script> --}}
  {{-- <script src="/js/part_js/additional_form.js"></script> --}}
  {{-- sd --}}


  <script src="/js/back/select2.full.min.js"></script>
  {{-- <script src="/js/back/jquery.bootstrap-duallistbox.min.js"></script> --}}
  <script src="/js/back/jquery.inputmask.min.js"></script>
  <script src="/js/back/moment.min.js"></script>
  {{-- <script src="/js/back/daterangepicker.js"></script> --}}
  {{-- <script src="/js/back/bootstrap-colorpicker.min.js"></script> --}}
  <script src="/js/back/tempusdominus-bootstrap-4.min.js"></script>
  {{-- <script src="/js/back/bootstrap-switch.min.js"></script> --}}
  {{-- <script src="/js/back/bs-stepper.min.js"></script> --}}
  {{-- <script src="/js/back/dropzone.min.js"></script> --}}
  {{-- <h2>Used setting for advanced forms</h2> --}}
  {{-- isi konten validasi --}}
  {{-- <script src="{{ asset('js/part_js/validasi.js') }}"></script> --}}


  <script>
    $('#tanggal_lahir').datetimepicker({
      // format: 'YYYY-MM-DD hh:mm:ss',
      format: 'YYYY-MM-DD',
    });

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

    $(function() {
      $("form[name='daftar_pengguna']").validate({
        // Specify validation rules
        rules: {
          nama: {
            required: true
          },
          nomer_induk: {
            required: true,
            angka: true,
            minlength: 6
          },
          email: {
            required: false,
            email: true // Specify that email should be validated by the built-in "email" rule
          },
          password: {
            required: true,
            minlength: 6
          },
          password_ulang: {
            required: true,
            minlength: 6,
            equalTo: "#password"
          },
          nisn: {
            minlength: 6
          },
          asal: {
            lettersonly: true
          },
          tempat_lahir: {
            lettersonly: true
          },

        },
        // Specify validation error messages
        messages: {
          nomer_induk: {
            required: "Nomor induk harus diisi.",
            angka: "Nomor induk hanya berupa kombinasi angka dan titik.",
            minlength: "*Nomor induk  minimal {0} karakter."
          },
          nama: "Nama lengkap harus diisi.",
          email: "Email harus berupa alamat yang valid.",
          password: {
            required: "Password harus diisi.",
            minlength: "Password minimal {0} karakter."
          },
          password_ulang: {
            required: "Konfirmasi password harus diisi.",
            equalTo: "Password konfirmasi tidak cocok.",
            minlength: "Password minimal {0} karakter."
          },
          nisn: {
            minlength: "NIDN minimal {0} angka."
          },
          kelas: "Kelas harus dipilih.",


        },
        highlight: function(element) {

          $(element).closest('.input-group > input').addClass('is-invalid');
          $(element).closest('.form-group > input').addClass('is-invalid');
          $(element).closest('.form-group > select').addClass('is-invalid');

        },
        unhighlight: function(element) {

          $(element).closest('.input-group > input').removeClass('is-invalid');
          $(element).closest('.form-group > input').removeClass('is-invalid');
          $(element).closest('.form-group > select').removeClass('is-invalid');

        },
        errorElement: 'div',
        errorClass: 'invalid-feedback',
        errorPlacement: function(error, element) {
          if (element.parent('.input-group').length) {
            error.insertAfter(element.parent());
          } else {
            error.insertAfter(element);
          }
        },
        submitHandler: function(form) {
          if ($("form[name='daftar_pengguna']").valid()) {
            console.log("valid >> " + form.isValid());
            form.submit();
          }
          // form.submit();
        }
      });
    });
  </script>
@endsection
