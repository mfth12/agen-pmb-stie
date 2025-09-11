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
        <form enctype="multipart/form-data" action="{{ route('penilaian.store') }}" method="POST" name="penilaian_buat">
          @csrf
          <div class="row">
            <div class="col-md-12">
              {{-- BS-STEPPER --}}
              {{-- BS-STEPPER --}}
              {{-- BS-STEPPER --}}
              <div class="card card-default">
                <div class="card-header">
                  <h3 class="card-title">Formulir
                  </h3>
                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                      <i class="fas fa-minus"></i>
                    </button>
                  </div>
                </div>
                <div class="card-body">
                  <div class="bs-stepper">
                    <div class="bs-stepper-header mb-3" role="tablist">
                      <!-- your steps here -->
                      <div class="step" data-target="#info-part">
                        <button type="button" class="step-trigger" role="tab" aria-controls="info-part"
                          id="info-part-trigger">
                          <span class="bs-stepper-circle">1</span>
                          <span class="bs-stepper-label">Informasi</span>
                        </button>
                      </div>
                      <div class="line"></div>
                      <div class="step" data-target="#penilaian-part">
                        <button type="button" class="step-trigger" role="tab" aria-controls="penilaian-part"
                          id="penilaian-part-trigger">
                          <span class="bs-stepper-circle">2</span>
                          <span class="bs-stepper-label">Nilai</span>
                        </button>
                      </div>
                      <div class="line"></div>
                      <div class="step" data-target="#submit-part">
                        <button type="button" class="step-trigger" role="tab" aria-controls="submit-part"
                          id="submit-part-trigger">
                          <span class="bs-stepper-circle">3</span>
                          <span class="bs-stepper-label">Kirim</span>
                        </button>
                      </div>
                    </div>
                    <div class="bs-stepper-content">
                      <!-- your steps content here -->
                      <div id="info-part" class="content" role="tabpanel" aria-labelledby="info-part-trigger">
                        <div class="row">
                          <div class="col-sm-8">

                            <div class="form-group">
                              <label for="yg_dinilai_id" class="control-label">Kepada</label>
                              {{-- JIKA SUPERADMIN DAN MANAGER --}}
                              @can('akses_superadmin_manager')
                                <select autofocus class="form-control @error('yg_dinilai_id') is-invalid @enderror select2"
                                  name="yg_dinilai_id" id="yg_dinilai_id">
                                  <option @empty(old('yg_dinilai_id')) selected @endempty disabled>
                                    -- Pilih Pegawai --
                                  </option>
                                  @foreach ($pengguna as $list)
                                    @if ($list->user_id == old('yg_dinilai_id'))
                                      <option value="{{ old('yg_dinilai_id') }}" selected>
                                      @else
                                      <option value="{{ $list->user_id }}">
                                    @endif
                                    {{ $list->nama }}</option>
                                  @endforeach
                                </select>
                              @else
                                {{-- PENGGUNA LAINNYA --}}
                                <select autofocus class="form-control @error('yg_dinilai_id') is-invalid @enderror select2"
                                  name="yg_dinilai_id" id="yg_dinilai_id">
                                  <option value="{{ old('yg_dinilai_id', auth()->user()->user_id) }}" selected>
                                    {{ auth()->user()->nama }}</option>
                                </select>
                              @endcan
                              @error('yg_dinilai_id')
                                <div class="invalid-feedback">
                                  {{ $message }}
                                </div>
                              @enderror
                            </div>
                          </div>
                          <div class="col-sm-4">
                            <div class="form-group">
                              <label for="periode_id" class="control-label">Tahun</label>
                              <select class="form-control @error('periode_id') is-invalid @enderror select2"
                                name="periode_id">
                                @foreach ($tahun as $thn)
                                  @if (session('konfigs')->periode_aktif == $thn->id_periode)
                                    <option value="{{ $thn->id_periode }}" selected>
                                      {{ $thn->periode }} (Periode Aktif)</option>
                                  @else
                                    <option disabled>{{ $thn->periode }}</option>
                                  @endif
                                @endforeach
                              </select>
                              @error('periode_id')
                                <div class="invalid-feedback">
                                  {{ $message }}
                                </div>
                              @enderror
                            </div>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-sm-12">
                            <label for="jenis">Penilaian sebagai?</label>
                            <div class="form-group ">
                              <div class="btn-group btn-group-toggle @error('jenis') is-invalid @enderror"
                                data-toggle="buttons">
                                <label
                                  class="btn btn-sm btn-outline-secondary {{ old('jenis') == '10' ? 'active' : '' }}">
                                  <input type="radio" name="jenis" id="jenis10" value="10"
                                    {{ old('jenis') == '10' ? 'checked' : '' }} autocomplete="off">
                                  Tendik
                                </label>
                                <label
                                  class="btn btn-sm btn-outline-secondary {{ old('jenis') == '11' ? 'active' : '' }}">
                                  <input type="radio" name="jenis" id="jenis11" value="11"
                                    {{ old('jenis') == '11' ? 'checked' : '' }} autocomplete="off">
                                  Dosen
                                </label>
                              </div>
                              @error('jenis')
                                <div class="invalid-feedback"> {{ $message }} </div>
                              @enderror
                            </div>
                          </div>
                        </div>

                        <div class="form-group">
                          <div class="row">
                            <div class="col-sm-12">
                              {{-- <small>
                                <label class="form-check-label">Catatan: Penilaian hanya dapat dilakukan satu kali
                                  dalam satu periode pada masing-masing pegawai.</label>
                              </small> --}}

                              {{-- penginput_id --}}
                              <input hidden type="text"
                                class="form-control @error('penginput_id') is-invalid @enderror" id="penginput_id"
                                name="penginput_id" value="{{ auth()->user()->user_id }}" placeholder="penginput_id">
                            </div>
                          </div>
                        </div>
                        <hr>
                        <div class="pt-0">
                          @if (request()->routeIs('penilaian.buat'))
                            <a href="{{ route('penilaian.index') }}" class="btn btn-default">Batalkan</a>
                          @endif
                          <a href="javascript:void(0)" id="tombol-lanjut1" class="btn btn-primary float-right"
                            onclick="stepper.next()">Lanjut<i class="fa-solid fa-chevron-right ml-1"></i></a>
                        </div>
                      </div>
                      <!-- your steps content here -->
                      <div id="penilaian-part" class="content" role="tabpanel"
                        aria-labelledby="penilaian-part-trigger">
                        <div class="row">
                          <div class="col-md-12">
                            {{-- 1. UMUM --}}
                            <div class="card">
                              <div class="card-header">
                                <h3 class="card-title"><b>Umum</b></h3>
                                <div class="card-tools">
                                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                  </button>
                                </div>
                              </div>
                              <div class="card-body">
                                <div class="row d-flex">
                                  <table class="table table-sm table-borderless">
                                    <tr>
                                      <td style="width: 45%; vertical-align: middle;">1. Disiplin</td>
                                      <td style="vertical-align: middle;">
                                        <div class="form-group mb-0">
                                          <input type="text"
                                            class="form-control @error('nilai_1a') is-invalid @enderror" id="nilai_1a"
                                            name="nilai_1a" value="{{ old('nilai_1a') }}" placeholder="Berikan nilai">
                                          @error('nilai_1a')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                          @enderror
                                        </div>
                                      </td>
                                    </tr>

                                    <tr>
                                      <td style="width: 45%; vertical-align: middle;">2. Etika</td>
                                      <td style="vertical-align: middle;">
                                        <div class="form-group mb-0">
                                          <input type="text"
                                            class="form-control @error('nilai_2a') is-invalid @enderror" id="nilai_2a"
                                            name="nilai_2a" value="{{ old('nilai_2a') }}" placeholder="Berikan nilai">
                                          @error('nilai_2a')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                          @enderror
                                        </div>
                                      </td>
                                    </tr>

                                    <tr>
                                      <td style="width: 45%; vertical-align: middle;">3. Tanggungjawab</td>
                                      <td style="vertical-align: middle;">
                                        <div class="form-group mb-0">
                                          <input type="text"
                                            class="form-control @error('nilai_3a') is-invalid @enderror" id="nilai_3a"
                                            name="nilai_3a" value="{{ old('nilai_3a') }}" placeholder="Berikan nilai">
                                          @error('nilai_3a')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                          @enderror
                                        </div>
                                      </td>
                                    </tr>

                                    <tr>
                                      <td style="width: 45%; vertical-align: middle;">4. Kerjasama</td>
                                      <td style="vertical-align: middle;">
                                        <div class="form-group mb-0">
                                          <input type="text"
                                            class="form-control @error('nilai_4a') is-invalid @enderror" id="nilai_4a"
                                            name="nilai_4a" value="{{ old('nilai_4a') }}" placeholder="Berikan nilai">
                                          @error('nilai_4a')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                          @enderror
                                        </div>
                                      </td>
                                    </tr>

                                    <tr>
                                      <td style="width: 45%; vertical-align: middle;">5. Prestasi kerja</td>
                                      <td style="vertical-align: middle;">
                                        <div class="form-group mb-0">
                                          <input type="text"
                                            class="form-control @error('nilai_5a') is-invalid @enderror" id="nilai_5a"
                                            name="nilai_5a" value="{{ old('nilai_5a') }}" placeholder="Berikan nilai">
                                          @error('nilai_5a')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                          @enderror
                                        </div>
                                      </td>
                                    </tr>

                                  </table>
                                </div>
                              </div>
                            </div>

                            {{-- 2. SPESIFIK --}}
                            {{-- <div class="card"> --}}
                            <div class="card" id="spesifik-card"
                              style="display: {{ old('jenis') == 'dosen' ? 'block' : 'none' }};">
                              <div class="card-header">
                                <h3 class="card-title"><b>Spesifik</b></h3>
                                <div class="card-tools">
                                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                  </button>
                                </div>
                              </div>
                              <div class="card-body">
                                <div class="row d-flex">
                                  <table class="table table-sm table-borderless">
                                    <tr>
                                      <td style="width: 45%; vertical-align: middle;">6. Penguatan materi pembelajaran
                                      </td>
                                      <td style="vertical-align: middle;">
                                        <div class="form-group mb-0">
                                          <input type="text"
                                            class="form-control @error('nilai_6a') is-invalid @enderror" id="nilai_6a"
                                            name="nilai_6a" value="{{ old('nilai_6a') }}" placeholder="Berikan nilai">
                                          @error('nilai_6a')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                          @enderror
                                        </div>
                                      </td>
                                    </tr>
                                    <tr>
                                      <td style="width: 45%; vertical-align: middle;">7. Inovasi </td>
                                      <td style="vertical-align: middle;">
                                        <div class="form-group mb-0">
                                          <input type="text"
                                            class="form-control @error('nilai_7a') is-invalid @enderror" id="nilai_7a"
                                            name="nilai_7a" value="{{ old('nilai_7a') }}" placeholder="Berikan nilai">
                                          @error('nilai_7a')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                          @enderror
                                        </div>
                                      </td>
                                    </tr>
                                    <tr>
                                      <td style="width: 45%; vertical-align: middle;">8. Penelitian
                                      </td>
                                      <td style="vertical-align: middle;">
                                        <div class="form-group mb-0">
                                          <input type="text"
                                            class="form-control @error('nilai_8a') is-invalid @enderror" id="nilai_8a"
                                            name="nilai_8a" value="{{ old('nilai_8a') }}" placeholder="Berikan nilai">
                                          @error('nilai_8a')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                          @enderror
                                        </div>
                                      </td>
                                    </tr>
                                    <tr>
                                      <td style="width: 45%; vertical-align: middle;">9. Pengabdian masyarakat
                                      </td>
                                      <td style="vertical-align: middle;">
                                        <div class="form-group mb-0">
                                          <input type="text"
                                            class="form-control @error('nilai_9a') is-invalid @enderror" id="nilai_9a"
                                            name="nilai_9a" value="{{ old('nilai_9a') }}" placeholder="Berikan nilai">
                                          @error('nilai_9a')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                          @enderror
                                        </div>
                                      </td>
                                    </tr>
                                  </table>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>

                        {{-- UNTUK NEXT STEP --}}
                        <div class="pt-3">
                          <a href="javascript:void(0)" onclick="stepper.previous()" class="btn btn-default"><i
                              class="fa-solid fa-chevron-left mr-1"></i>Kembali</a>
                          <a href="javascript:void(0)" id="tombol-lanjut2" class="btn btn-primary float-right"
                            onclick="stepper.next()">Lanjut<i class="fa-solid fa-chevron-right ml-1"></i></a>
                        </div>
                      </div>


                      <!-- your steps content here -->
                      <div id="submit-part" class="content" role="tabpanel" aria-labelledby="submit-part-trigger">
                        <div class="card">
                          <div class="card-header" style="vertical-align: middle">
                            <h3 class="card-title"><b>Pernyataan</b></h3>
                            <div class="card-tools">
                              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                              </button>
                            </div>
                          </div>
                          <div class="card-body">
                            <div class="row d-flex">
                              {{--  --}}
                              <div class="col-md-12">
                                <div class="form-group">
                                  <div class="icheck-primary ">
                                    <input type="checkbox" id="ttd" name="ttd_penginput"
                                      class="@error('ttd_penginput')is-invalid @enderror"
                                      {{ old('ttd_penginput') == 'on' ? 'checked' : '' }}>
                                    <label for="ttd">Tanda tangan</label>
                                    <span> dengan ini saya menyatakan bahwa penilaian ini sah secara administratif dan
                                      dapat dipertanggungjawabkan.</span>
                                    @error('ttd_penginput')
                                      <div class="invalid-feedback"> {{ $message }} </div>
                                    @enderror
                                  </div>
                                </div>
                              </div>

                            </div>
                          </div>
                        </div>

                        {{-- tombol submit --}}
                        <div class="pt-3">
                          <a href="javascript:void(0)" onclick="stepper.previous()" class="btn btn-default"><i
                              class="fa-solid fa-chevron-left mr-1"></i>Kembali</a>
                          <button type="submit" id="tombol-kirim" class="btn btn-primary float-right">Kirim
                            <i class="fa-solid fa-paper-plane ml-1"></i></button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              {{-- BS-STEPPER --}}
              {{-- BS-STEPPER --}}
              {{-- BS-STEPPER --}}
            </div>
          </div>
        </form>
      </div>
    </section>

  </div>
@endsection

@section('js_atas')
  {{-- <link rel="stylesheet" href="{{ asset('css/back/daterangepicker.css') }}"> --}}
  {{-- <link rel="stylesheet" href="{{ asset('css/back/bootstrap-colorpicker.min.css') }}"> --}}
  {{-- <link rel="stylesheet" href="{{ asset('css/back/tempusdominus-bootstrap-4.min.css') }}"> --}}
  <link rel="stylesheet" href="{{ asset('css/back/select2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css/back/select2-bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css/back/bs-stepper.min.css') }}">
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
  <script src="{{ asset('js/back/jquery.inputmask.min.js') }}"></script>
  <script src="{{ asset('js/back/select2.full.min.js') }}"></script>
  <script src="{{ asset('js/back/moment.min.js') }}"></script>
  <script src="{{ asset('js/back/tempusdominus-bootstrap-4.min.js') }}"></script>
  <script src="{{ asset('js/back/daterangepicker.js') }}"></script>
  <script src="{{ asset('js/back/bs-stepper.min.js') }}"></script>

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

    document.addEventListener('DOMContentLoaded', function() {
      const jenis10 = document.getElementById('jenis10');
      const jenis11 = document.getElementById('jenis11');
      const spesifikCard = document.getElementById('spesifik-card');

      // Fungsi untuk menampilkan atau menyembunyikan card Spesifik
      function toggleSpesifikCard() {
        if (jenis11.checked) {
          spesifikCard.style.display = 'block';
        } else {
          spesifikCard.style.display = 'none';
        }
      }
      // Event listener ketika radio button berubah
      jenis10.addEventListener('change', toggleSpesifikCard);
      jenis11.addEventListener('change', toggleSpesifikCard);
      // Panggil fungsi saat pertama kali halaman dimuat
      toggleSpesifikCard();
    });

    // BS-Stepper Init
    document.addEventListener('DOMContentLoaded', function() {
      window.stepper = new Stepper(document.querySelector('.bs-stepper'))
      document.getElementById('yg_dinilai_id').focus();
    })


    jQuery.validator.addMethod("lettersonly", function(value, element) {
      return this.optional(element) || /^[a-zA-Z\s]+$/i.test(value);
    }, "Input hanya berupa huruf.");

    jQuery.validator.addMethod("angka100", function(value, element) {
      // Pastikan nilai input adalah angka dan berada dalam rentang 1-100
      return this.optional(element) || (/^\d+$/.test(value) && parseInt(value, 10) >= 1 && parseInt(value, 10) <=
        100);
    }, "Hanya berupa angka dari 1 sampai 100");

    // Fungsi untuk menghasilkan aturan validasi
    function generateValidationRules(fields) {
      var rules = {};
      fields.forEach(function(field) {
        rules[field] = {
          required: true,
          angka100: field !== 'yg_dinilai_id'
        };
      });
      return rules;
    }

    // Fungsi untuk menghasilkan pesan validasi
    function generateValidationMessages(fields) {
      var messages = {};
      fields.forEach(function(field) {
        messages[field] = {
          required: field === 'yg_dinilai_id' ? "Pengguna harus dipilih disini" : "Nilai harus diisi"
        };
      });
      return messages;
    }

    // Daftar field yang akan divalidasi
    var fields = [
      "yg_dinilai_id",
      "nilai_1a", // tendik & dosen
      "nilai_2a",
      "nilai_3a",
      "nilai_4a",
      "nilai_5a",
      "nilai_6a", // dosen
      "nilai_7a",
      "nilai_8a",
      "nilai_9a",
      // "nilai_1b", // tendik & dosen
      // "nilai_2b",
      // "nilai_3b",
      // "nilai_4b",
      // "nilai_5b",
      // "nilai_6b", // dosen
      // "nilai_7b",
      // "nilai_8b",
      // "nilai_9b",
    ];

    // Wait for the DOM to be ready
    $(function() {
      $("form[name='penilaian_buat']").validate({
        // Specify validation rules
        rules: generateValidationRules(fields),
        // Specify validation error messages
        messages: generateValidationMessages(fields),
        // bagian yang dihighlight
        highlight: function(element) {
          $(element).closest('.input-group > input').addClass('is-invalid');
          $(element).closest('.form-group > input').addClass('is-invalid');
          $(element).closest('.form-group > select').addClass('is-invalid');
          $(element).closest('.form-group > span').addClass('is-invalid');
          $(element).closest('.form-group > span > span').addClass('is-invalid');
          $(element).closest('.form-group > textarea').addClass('is-invalid');
          $(element).closest('.form-group > div > input').addClass('is-invalid');
          $(element).closest('.form-group > span > input').addClass('is-invalid');
        },
        unhighlight: function(element) {
          $(element).closest('.input-group > input').removeClass('is-invalid');
          $(element).closest('.form-group > input').removeClass('is-invalid');
          $(element).closest('.form-group > select').removeClass('is-invalid');
          $(element).closest('.form-group > span').removeClass('is-invalid');
          $(element).closest('.form-group > span > span').removeClass('is-invalid');
          $(element).closest('.form-group > textarea').removeClass('is-invalid');
          $(element).closest('.form-group > div > input').removeClass('is-invalid');
          $(element).closest('.form-group > span > input').removeClass('is-invalid');
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
          console.log("valid >> " + form.isValid());
          form.submit();
        }
      });
    });
  </script>
@endsection
