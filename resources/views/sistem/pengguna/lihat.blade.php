@extends('components.theme.back')

@section('container')
  {{-- Content Wrapper. Contains page content --}}
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
    @php
      use App\Models\Level_pengguna;
      $kosong = '<i>(Belum ada data)</i>';
    @endphp

    {{-- Main content --}}
    <section class="content">
      <div class="container">
        <div class="row">
          <div class="col-md-3">
            <!-- Profile Image -->
            @if ($pengguna->status == 1)
              <div class="card card card-outline">
              @else
                <div class="card card card-outline">
            @endif
            <div class="card-body box-profile">
              <div class="text-center image_area mb-2">
                <img class="profile-user-img img-fluid img-responsive img-circle" style="width: 55%"
                  src="{{ asset('storage/' . $pengguna->detail->foto) }}">
              </div>

              <h3 class="profile-username text-center my-1" style="font-size: 24px;">{{ $pengguna->nama }}</h3>

              <p class="text-muted text-center my-1">
              </p>

              <p class="text-muted text-center my-1">
                @if (request()->routeIs('profil*'))
                  @if ($jikaketua !== null && $jikaketua->ketua_id == auth()->user()->user_id)
                    {{ $jikaketua->titel_unit ?? '' }} {{ $jikaketua->nama_unit ?? '' }}
                  @else
                    Staff {{ $unitkerja->nama_unit ?? '' }}
                  @endif
                @elseif (request()->routeIs('pengguna*'))
                  @if ($jikaketua !== null && $jikaketua->ketua_id == $pengguna->user_id)
                    {{ $jikaketua->titel_unit ?? '' }} {{ $jikaketua->nama_unit ?? '' }}
                  @else
                    Staff {{ $unitkerja->nama_unit ?? '' }}
                  @endif
                @endif
                {{-- data adalah: {{ $jikaketua }} --}}
              </p>

              <p class="text-muted text-center my-1">
                NPPY. {{ $pengguna->nomer_induk }}
              </p>
              <div class="row d-flex justify-content-center">
                <div class="">
                  @if ($pengguna->status == 1)
                    <p class="text-center mt-1 mb-3 badge-outline-secondary"
                      style="color: rgb(8, 151, 8); padding: 0.1em 1em;">
                      Status Aktif
                    </p>
                  @elseif ($pengguna->status == 0)
                    <p class="text-center mt-1 mb-3 badge-outline-secondary" style="padding: 0.1em 1em;">
                      Status Non-aktif
                    </p>
                  @endif
                </div>
              </div>

              <ul class="list-group list-group-unbordered mb-1 no-select">
                <li class="list-group-item">
                  Terakhir akses <a class="float-right text-secondary" href="javascript:void(0);" data-toggle="tooltip"
                    data-placement="top" data-html="true" title="
                    {!! $pengguna->last_login_at
                        ? 'Tanggal:' .
                            \Carbon\Carbon::parse($pengguna->last_login_at)->translatedFormat('j F Y') .
                            ' ' .
                            \Carbon\Carbon::parse($pengguna->last_login_at)->translatedFormat('H:i') .
                            '<br>' .
                            'IP:' .
                            $pengguna->last_login_ip
                        : $kosong !!}">
                    {!! $pengguna->last_login_at ? \Carbon\Carbon::parse($pengguna->last_login_at)->diffForHumans() : 'Belum pernah' !!}
                  </a>
                </li>
                <li class="list-group-item text-nowrap">
                  Email
                  <a class="float-right text-secondary" href="javascript:void(0);" data-toggle="tooltip"
                    data-placement="top" title="{{ $pengguna->email }}">
                    {!! strlen($pengguna->email) > 18
                        ? substr($pengguna->email, 0, 18) . '..'
                        : $pengguna->email ?? 'Belum terdaftar' !!}
                  </a>
                </li>
                <li class="list-group-item">
                  Terdaftar <a class="float-right text-secondary" href="javascript:void(0);" data-toggle="tooltip"
                    data-placement="top" title="{{ $pengguna->created_at->translatedFormat('j F Y H:i') }}">
                    {{ $pengguna->created_at->translatedFormat('j M Y') }}
                  </a>
                </li>
              </ul>

              <div class="row d-flex justify-content-center mt-3">
                <div class="col-md-6 col-6">
                  <a href="javascript:void(0)" id="tombol-tambah" class="btn btn-default btn-block text-nowrap">
                    Sandi
                  </a>
                </div>
                <div class="col-md-6 col-6">
                  <a href="{{ request()->routeIs('profil*') ? route('profil.ubah') : url()->current() . '/edit' }}"
                    class="btn btn-default btn-block text-nowrap">
                    Ubah
                  </a>
                </div>
              </div>

            </div>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="card">
            <div class="card-header p-2">
              <ul class="nav nav-pills flex-nowrap overflow-auto" style="white-space: nowrap;">
                <li class="nav-item"><a class="nav-link active" href="#biodata" data-toggle="tab">Biodata</a></li>
                <li class="nav-item"><a class="nav-link" href="#rekam_jejak" data-toggle="tab">Rekam Jejak</a></li>
                <li class="nav-item"><a class="nav-link" href="#prestasi" data-toggle="tab">Prestasi</a>
                <li class="nav-item"><a class="nav-link" href="#pendidikan" data-toggle="tab">Pendidikan</a>
                <li class="nav-item"><a class="nav-link" href="#keluarga" data-toggle="tab">Keluarga</a>
                <li class="nav-item"><a class="nav-link" href="/presensi/lihat/{{ $pengguna->user_id }}">Presensi
                    <i class="fas fa-arrow-up-right-from-square ml-1 fa-sm"></i></a>
                </li>
              </ul>
            </div><!-- /.card-header -->
            <div class="card-body">
              <div class="tab-content">
                <div class="active tab-pane" id="biodata">
                  {{-- Post --}}
                  <div class="row">
                    {{-- left column --}}
                    <div class="col-md-7">
                      <div class="card">
                        <div class="card-header">
                          <h3 class="card-title">Biodata</h3>
                        </div>
                        <div class="card-body">


                          <table class="table table-borderless">
                            <tr>
                              <td style="width: 40%"><b>NIDN </b></td>
                              <td>: {!! $pengguna->detail->nisn ?? $kosong !!}</td>
                            </tr>
                            <tr>
                              <td style="width: 40%"><b>Nama Lengkap</b></td>
                              <td>: {!! $pengguna->nama ?? $kosong !!}</td>
                            </tr>
                            <tr>
                              <td style="width: 40%"><b>Panggilan</b></td>
                              <td>: {!! $pengguna->detail->panggilan ?? $kosong !!}</td>
                            </tr>
                            <tr>
                              <td style="width: 40%"><b>Email</b></td>
                              <td>: {!! $pengguna->email ?? $kosong !!}</td>
                            </tr>
                            <tr>
                              <td style="width: 40%"><b>Jenis Kelamin</b></td>
                              <td>: {!! $pengguna->detail->jenis_kelamin ?? $kosong !!}</td>
                            </tr>
                            <tr>
                              <td style="width: 40%;"><b>Tempat, Tanggal Lahir</b></td>
                              @php $u = Carbon\Carbon::parse($pengguna->detail->tanggal_lahir)->format('j F Y') @endphp
                              <td>:
                                @if ($pengguna->detail->tempat_lahir && $pengguna->detail->tanggal_lahir)
                                  {{ $pengguna->detail->tempat_lahir . ', ' . $u }}
                                @elseif($pengguna->detail->tempat_lahir)
                                  {{ $pengguna->detail->tempat_lahir }}
                                @elseif($pengguna->detail->tanggal_lahir)
                                  {{ $u }}
                                @else
                                  {!! $kosong !!}
                                @endif
                              </td>
                            </tr>
                            <tr>
                              <td style="width: 40%;"><b>Alamat Lengkap</b></td>
                              <td>: {!! $pengguna->detail->alamat ?? $kosong !!}</td>
                            </tr>
                          </table>
                          <hr>
                          <table class="table table-borderless">
                            <tr>
                              <td style="width: 40%;"><b>Nama Ayah</b></td>
                              <td>: {!! $pengguna->detail->nama_ayah ?? $kosong !!}

                              </td>
                            </tr>
                            <tr>
                              <td style="width: 40%;"><b>Pekerjaan</b></td>
                              <td>: {!! $pengguna->detail->pekerjaan_ayah ?? $kosong !!}</td>
                            </tr>
                            <tr>
                              <td style="width: 40%;"><b>Nama Ibu</b></td>
                              <td>: {!! $pengguna->detail->nama_ibu ?? $kosong !!}

                              </td>
                            </tr>
                            <tr>
                              <td style="width: 40%;"><b>Pekerjaan</b></td>
                              <td>: {!! $pengguna->detail->pekerjaan_ibu ?? $kosong !!}</td>
                            </tr>
                          </table>
                        </div>
                      </div>
                    </div>

                    {{-- kolom pendidikan --}}
                    <div class="col-md-5">
                      <div class="card">
                        <div class="card-header">
                          <h3 class="card-title">Riwayat Pendidikan</h3>
                          <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                              <i class="fas fa-minus"></i>
                            </button>
                          </div>
                        </div>
                        <div class="card-body">
                          <table id="example1" class="table table-bordered table-hover">
                            <thead>
                              <tr>
                                <th>No.</th>
                                <th>Lembaga</th>
                                <th>Tahun</th>
                              </tr>
                            </thead>

                            <tbody>
                              <tr>
                                <td>1</td>
                                <td>(Kosong)</td>
                                <td>(Kosong)</td>
                              </tr>
                              <tr>
                                <td>2</td>
                                <td>(Kosong)</td>
                                <td>(Kosong)</td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                      </div>

                      <div class="card">
                        <div class="card-header">
                          <h3 class="card-title">Riwayat Penyakit Dalam</h3>
                          <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                              <i class="fas fa-minus"></i>
                            </button>
                          </div>
                        </div>
                        <div class="card-body">
                          <table id="example1" class="table table-bordered table-hover">
                            <thead>
                              <tr>
                                <th>No.</th>
                                <th>Nama Penyakit</th>
                                <th>Tahun</th>
                              </tr>
                            </thead>

                            <tbody>
                              <tr>
                                <td>1</td>
                                <td>(Kosong)</td>
                                <td>(Kosong)</td>
                              </tr>

                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                    <!-- /.post -->
                  </div>
                </div>
                <!-- /.tab-pane -->
                <div class="tab-pane" id="rekam_jejak">
                  <div class="timeline timeline-inverse">
                    <!-- timeline time label -->
                    <div class="time-label">
                      <span class="bg-gradient-secondary"
                        style="padding: 2px 0.8rem; border-radius: 1rem; font-weight:500">
                        10 Feb 2014
                      </span>
                    </div>
                    <!-- /.timeline-label -->
                    <!-- timeline item -->
                    <div style="margin-right: 0rem">
                      <i class="fas fa-envelope bg-primary"></i>

                      <div class="timeline-item" style="margin-right: 0rem">
                        <span class="time"><i class="far fa-clock"></i>
                          12:05</span>

                        <h3 class="timeline-header"><a href="#">Support Team</a> sent
                          you an
                          email</h3>

                        <div class="timeline-body">
                          Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles,
                          weebly ning heekya handango imeem plugg dopplr jibjab, movity
                          jajah plickers sifteo edmodo ifttt zimbra. Babblely odeo
                          kaboodle
                          quora plaxo ideeli hulu weebly balihoo...
                        </div>
                        <div class="timeline-footer">
                          <a href="#" class="btn btn-primary btn-sm">Read more</a>
                          <a href="#" class="btn btn-danger btn-sm">Delete</a>
                        </div>
                      </div>
                    </div>
                    <!-- END timeline item -->
                    <!-- timeline item -->
                    <div style="margin-right: 0rem">
                      <i class="fas fa-user bg-info"></i>

                      <div class="timeline-item" style="margin-right: 0rem">
                        <span class="time"><i class="far fa-clock"></i> 5 mins
                          ago</span>

                        <h3 class="timeline-header border-0"><a href="#">Sarah Young</a>
                          accepted your friend
                          request
                        </h3>
                      </div>
                    </div>
                    <!-- END timeline item -->
                    <!-- timeline item -->
                    <div style="margin-right: 0rem">
                      <i class="fas fa-comments bg-warning"></i>

                      <div class="timeline-item" style="margin-right: 0rem">
                        <span class="time"><i class="far fa-clock"></i> 27 mins
                          ago</span>

                        <h3 class="timeline-header"><a href="#">Jay White</a> commented
                          on
                          your
                          post</h3>

                        <div class="timeline-body">
                          Take me to your leader!
                          Switzerland is small and neutral!
                          We are more like Germany, ambitious and misunderstood!
                        </div>
                        <div class="timeline-footer">
                          <a href="#" class="btn btn-warning btn-flat btn-sm">View
                            comment</a>
                        </div>
                      </div>
                    </div>
                    <!-- END timeline item -->
                    <!-- timeline time label -->
                    <div class="time-label">
                      <span class="bg-gradient-success"
                        style="padding: 2px 0.8rem; border-radius: 1rem; font-weight:500">
                        3 Jan 2014
                      </span>
                    </div>
                    <!-- /.timeline-label -->
                    <!-- timeline item -->
                    <div style="margin-right: 0rem">
                      <i class="fas fa-camera bg-purple"></i>

                      <div class="timeline-item" style="margin-right: 0rem">
                        <span class="time"><i class="far fa-clock"></i> 2 days
                          ago</span>

                        <h3 class="timeline-header"><a href="#">Mina Lee</a> uploaded
                          new
                          photos</h3>

                        <div class="timeline-body">
                          <img src="https://placehold.jp/150x110.png" alt="...">
                          <img src="https://placehold.jp/150x110.png" alt="...">
                          <img src="https://placehold.jp/150x110.png" alt="...">
                          <img src="https://placehold.jp/150x110.png" alt="...">
                        </div>
                      </div>
                    </div>
                    <!-- END timeline item -->
                    <div>
                      <i class="far fa-clock bg-gray"></i>
                    </div>
                  </div>
                </div>
                <!-- /.tab-pane -->

                <div class="tab-pane" id="prestasi">
                  Prestasi pegawai internal dan eksternal lembaga
                  {{-- <form class="form-horizontal">
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                          <input type="email" class="form-control" id="inputName" placeholder="Name">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                          <input type="email" class="form-control" id="inputEmail" placeholder="Email">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputName2" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="inputName2" placeholder="Name">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputExperience" class="col-sm-2 col-form-label">Experience</label>
                        <div class="col-sm-10">
                          <textarea class="form-control" id="inputExperience" placeholder="Experience"></textarea>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputSkills" class="col-sm-2 col-form-label">Skills</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="inputSkills" placeholder="Skills">
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <div class="checkbox">
                            <label>
                              <input type="checkbox"> I agree to the <a href="#">terms
                                and
                                conditions</a>
                            </label>
                          </div>
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <button type="submit" class="btn btn-danger">Submit</button>
                        </div>
                      </div>
                    </form> --}}
                </div>

                <div class="tab-pane" id="pendidikan">
                  Riwayat pendidikan formal dan non-formal
                </div>

                <div class="tab-pane" id="keluarga">
                  Data keluarga dan kerabat dekat
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
  {{-- kosong --}}
@endsection

@section('style')
  <style>
    .table-borderless td,
    .table-borderless th {
      padding: 0.75rem 0.75rem 0.75rem 0rem;
    }

    .badge-outline-secondary {
      text-align: center;
      color: #6c757d;
      background-color: transparent;
      border-color: #6c757d;
      border: 1px solid;
      border-radius: 1rem;
    }

    .no-select::selection,
    .no-select *::selection {
      background-color: Transparent;
    }

    .no-select {
      /* Sometimes I add this too. */
      cursor: default;
    }

    .cursor-pointer {
      cursor: pointer;
    }
  </style>
@endsection

@section('js_bawah')
  {{-- MODAL PERBARUI PASSWORD --}}
  <div class="modal fade" id="tambah-edit-modal" data-backdrop="static" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog ">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modal-judul"></h5>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <form id="form-tambah-edit" name="form-tambah-edit" action="/pengguna/ubahpassword/{{ $pengguna->user_id }}"
            class="form-horizontal" enctype="multipart/form-data" method="POST">
            @csrf
            <div class="row">
              <div class="col-md-12">
                {{-- kondisi untuk menampilkan password skrng atau tidak --}}
                @if (in_array(auth()->user()->role, [Level_pengguna::IS_SUPERADMIN, Level_pengguna::IS_MANAGER]) &&
                        auth()->user()->user_id == $pengguna->user_id)
                  <input type="hidden" name="user_id" value="{{ auth()->user()->user_id }}">
                  <div class="form-group">
                    <label for="password">Kata Sandi Lama</label>
                    <div class="input-group">
                      <input type="password" class="form-control @error('password') is-invalid @enderror"
                        id="password" name="password" value="{{ old('password') }}">
                      <div class="input-group-append">
                        <button class="btn btn-default" type="button" id="showPasswordBtn">
                          <i class="fas fa-eye"></i>
                        </button>
                      </div>
                    </div>
                    @error('password')
                      <div class="invalid-feedback">
                        *{{ $message }}
                      </div>
                    @enderror
                  </div>
                @elseif(auth()->user()->user_id == $pengguna->user_id)
                  <input type="hidden" name="user_id" value="{{ auth()->user()->user_id }}">
                  <div class="form-group">
                    <label for="password">Kata Sandi Lama</label>
                    <div class="input-group">
                      <input type="password" class="form-control @error('password') is-invalid @enderror"
                        id="password" name="password" value="{{ old('password') }}">
                      <div class="input-group-append">
                        <button class="btn btn-default" type="button" id="showPasswordBtn">
                          <i class="fas fa-eye"></i>
                        </button>
                      </div>
                    </div>
                    @error('password')
                      <div class="invalid-feedback">
                        *{{ $message }}
                      </div>
                    @enderror
                  </div>
                @elseif(in_array(auth()->user()->role, [Level_pengguna::IS_SUPERADMIN, Level_pengguna::IS_MANAGER]))
                  <input type="hidden" name="user_id" value="{{ $pengguna->user_id }}">
                  <input type="hidden" class="form-control @error('password') is-invalid @enderror"
                    name="password_signed" value="signed">
                  @error('password')
                    <div class="invalid-feedback">
                      *{{ $message }}
                    </div>
                  @enderror
                @endif

                <div class="form-group">
                  <label for="new_password">Kata Sandi Baru</label>
                  <div class="input-group">
                    <input type="password" class="form-control @error('new_password') is-invalid @enderror"
                      id="new_password" name="new_password">
                    <div class="input-group-append">
                      <button class="btn btn-default" type="button" id="showNewPasswordBtn">
                        <i class="fas fa-eye"></i>
                      </button>
                    </div>
                  </div>
                  @error('new_password')
                    <div class="invalid-feedback">
                      *{{ $message }}
                    </div>
                  @enderror
                </div>

                <div class="form-group">
                  <label for="password_ulang">Ulangi Kata Sandi</label>
                  <div class="input-group">
                    <input type="password" class="form-control @error('password_ulang') is-invalid @enderror"
                      id="password_ulang" name="password_ulang">
                    <div class="input-group-append">
                      <button class="btn btn-default" type="button" id="showNewValidPasswordBtn">
                        <i class="fas fa-eye"></i>
                      </button>
                    </div>
                  </div>
                  @error('password_ulang')
                    <div class="invalid-feedback">
                      *{{ $message }}
                    </div>
                  @enderror
                </div>

                <hr class="mt-4">
              </div>
              <div class="col">
                <button type="submit" class="btn btn-primary btn-block" id="tombol-simpan"
                  value="create">Buat</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  {{-- AKHIR MODAL --}}

  <script type="text/javascript">
    //CSRF TOKEN PADA HEADER
    //Script ini wajib krn kita butuh csrf token setiap kali mengirim request post, patch, put dan delete ke server
    $(document).ready(function() {
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
    });

    //TOMBOL PERBARUI PASSSWORD
    //jika tombol-tambah diklik maka
    $('#tombol-tambah').click(function() {
      $('#tombol-simpan').val("create-post"); //valuenya menjadi create-post
      $('#pengguna_id').val(''); //valuenya menjadi kosong
      $('.is-invalid').removeClass('is-invalid'); // Menghapus kelas is-invalid pada elemen input jika valid
      $('.invalid-feedback').remove(); // Menghapus elemen dengan class invalid-feedback
      $('#form-tambah-edit').trigger("reset"); //mereset semua input dll didalamnya
      $('#modal-judul').html("Perbarui Kata Sandi"); //valuenya tambah pegawai baru
      $('#tambah-edit-modal').modal('show'); //modal tampil
      $('#tombol-simpan').html('Perbarui'); //ubah teks tombol
      $('#password').focus(); // Auto focus pada input dengan ID password
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
          password: {
            required: true,
            maxlength: 64,
          },
          new_password: {
            required: true,
            maxlength: 64,
            minlength: 6,
          },
          password_ulang: {
            required: true,
            maxlength: 64,
            minlength: 6,
            equalTo: "#new_password",

          },
        },
        messages: {
          password: {
            required: "Kata sandi lama harus diisi",
            maxlength: "Kata sandi maksimal {0} karakter",
          },
          new_password: {
            required: "Kata sandi baru harus diisi",
            maxlength: "Kata sandi maksimal {0} karakter",
            minlength: "Kata sandi minimal {0} karakter",
          },
          password_ulang: {
            required: "Ulangi kata sandi baru Anda",
            maxlength: "Kata sandi maksimal {0} karakter",
            minlength: "Kata sandi minimal {0} karakter",
            equalTo: "Kata sandi tidak cocok",
          },
        },

        submitHandler: function(form) {
          var actionType = $('#tombol-simpan').val();
          $('#tombol-simpan').html('Mengganti sandi..');

          if ($("form[name='form-tambah-edit']").valid()) {
            console.log("valid >> " + form.isValid());
            form.submit();
          }
        }
      })
    }

    $(document).ready(function() {
      // Fungsi untuk menampilkan atau menyembunyikan password
      $('#showPasswordBtn').click(function() {
        var passwordField = $('#password');
        var fieldType = passwordField.attr('type');
        if (fieldType === 'password') {
          passwordField.attr('type', 'text');
          $(this).find('i').removeClass('fa-eye').addClass('fa-eye-slash');
        } else {
          passwordField.attr('type', 'password');
          $(this).find('i').removeClass('fa-eye-slash').addClass('fa-eye');
        }
      });

      $('#showNewPasswordBtn').click(function() {
        var newPasswordField = $('#new_password');
        var fieldType = newPasswordField.attr('type');
        if (fieldType === 'password') {
          newPasswordField.attr('type', 'text');
          $(this).find('i').removeClass('fa-eye').addClass('fa-eye-slash');
        } else {
          newPasswordField.attr('type', 'password');
          $(this).find('i').removeClass('fa-eye-slash').addClass('fa-eye');
        }
      });

      $('#showNewValidPasswordBtn').click(function() {
        var newValidPasswordField = $('#password_ulang');
        var fieldType = newValidPasswordField.attr('type');
        if (fieldType === 'password') {
          newValidPasswordField.attr('type', 'text');
          $(this).find('i').removeClass('fa-eye').addClass('fa-eye-slash');
        } else {
          newValidPasswordField.attr('type', 'password');
          $(this).find('i').removeClass('fa-eye-slash').addClass('fa-eye');
        }
      });
    });
  </script>
@endsection
