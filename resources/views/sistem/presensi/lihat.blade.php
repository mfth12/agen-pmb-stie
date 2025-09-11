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
      $kosong = '<i>(Tidak ada data)</i>';
      use App\Models\Perizinan;
      use App\Models\Percutian;
    @endphp

    {{-- Main content --}}
    <section class="content">
      <div class="container">
        <div class="row">
          <div class="col-md-3">
            <!-- Profile Image -->
            <div class="card">
              <div class="card-body box-profile">
                <div class="text-center image_area mb-2">
                  <img class="profile-user-img img-fluid img-responsive img-circle" style="width: 36%"
                    src="{{ asset('storage/' . $pengguna->detail->foto) }}">
                </div>

                <h3 class="profile-username text-center my-1" style="font-size: 24px">
                  @canany(['akses_superadmin', 'akses_manager'])
                    <a href="/pengguna/{{ $pengguna->user_id }}" class="text-decoration-none  text-dark"
                      data-toggle="tooltip" data-placement="right" title="Lihat profil"> {{ $pengguna->nama }}</a>
                  @else
                    {{ $pengguna->nama }}
                  @endcanany
                </h3>
                <p class="text-muted text-center my-1"></i>FingerID: <a class="text-blue">{{ $pengguna->uid }}</a>
                </p>
                <div class="row d-flex justify-content-center">
                  <div>
                    @php
                      # namespace
                      # nothing
                      if ($jadwalToday) {
                          if ($presensiHariIni) {
                              if ($presensiMasuk) {
                                  $jamMasuk = strtotime($jadwalToday->jadwal[0]->jam_masuk);
                                  $userMasuk = strtotime($presensiMasuk->waktuPresensi);
                                  // Hitung perbedaan waktu dalam detik
                                  $perbedaanWaktu = $userMasuk - $jamMasuk;
                                  if ($perbedaanWaktu < -900) {
                                      // Pengguna masuk 15 menit lebih awal atau lebih tepat waktu
                                      // echo 'Masuk tepat waktu';
                                      echo '<p class="text-center mt-1 mb-3 badge-outline-secondary"
                                      style="color: rgb(8, 151, 8); padding: 0.1em 1em;">
                                      Masuk awal</p>';
                                  } elseif ($perbedaanWaktu >= -900 && $perbedaanWaktu < 0) {
                                      // Pengguna masuk 15 menit lebih awal dari jadwal
                                      // echo 'Masuk lebih awal';
                                      echo '<p class="text-center mt-1 mb-3 badge-outline-secondary"
                                      style="color: rgb(8, 151, 8); padding: 0.1em 1em;">
                                      Tepat waktu</p>';
                                  } elseif ($perbedaanWaktu >= 3600) {
                                      // Pengguna terlambat masuk lebih dari 1 jam
                                      $jamTerlambat = floor($perbedaanWaktu / 3600);
                                      $menitTerlambat = floor(($perbedaanWaktu % 3600) / 60);
                                      // echo "Masuk terlambat $jamTerlambat jam $menitTerlambat menit";
                                      echo "<p class=\"text-center mt-1 mb-3 badge-outline-secondary\"
                                      style=\"padding: 0.1em 1em;\">
                                      Terlambat $jamTerlambat jam $menitTerlambat menit</p>";
                                  } else {
                                      // Pengguna terlambat masuk kurang dari 1 jam
                                      $menitTerlambat = floor($perbedaanWaktu / 60);
                                      // echo "Masuk terlambat $menitTerlambat menit";
                                      echo "<p class=\"text-center mt-1 mb-3 badge-outline-secondary\"
                                      style=\"padding: 0.1em 1em;\">
                                      Terlambat $menitTerlambat menit</p>";
                                  }
                                  // echo $jadwalToday->jadwal[0]->nama_jadwal;
                              }
                          } else {
                              // belum melakukan finger
                              echo '<p class="text-center mt-1 badge-outline-secondary"
                                    style="padding: 0.1em 1em;">
                                    Belum melakukan presensi</p>';
                          }
                      } else {
                          echo '<p class="text-center mt-1 badge-outline-secondary" 
                          style="padding: 0.1em 1em 0.2em 1em;">
                          Tidak memiliki jadwal hari ini</p>';
                      }
                    @endphp
                    {{-- {!! $status !!} --}}
                  </div>
                </div>
                {{-- <p class="text-muted text-md text-center"> --}}
                @php
                  # namespace
                  use Carbon\Carbon;
                  if ($jadwalToday) {
                      if ($presensiMasuk) {
                          # code...
                          $string_jamMasuk = Carbon::parse($jadwalToday->jadwal[0]->jam_masuk)->format('H:i');
                          $string_userMasuk = Carbon::parse($presensiMasuk->waktuPresensi)->format('H:i');
                      }
                      if ($presensiPulang) {
                          # code...
                          $string_jamPulang = Carbon::parse($jadwalToday->jadwal[0]->jam_pulang)->format('H:i');
                          $string_userPulang = Carbon::parse($presensiPulang->waktuPresensi)->format('H:i');
                      }
                  }
                @endphp
                {{-- </p> --}}
                <ul class="list-group list-group-unbordered no-select">
                  @if ($jadwalToday)
                    @if ($presensiMasuk)
                      <li class="list-group-item">
                        Masuk
                        @if ($presensiMasuk->_ver > 1)
                          <i class="text-muted"> (Terpindai {{ $presensiMasuk->_ver . 'x' }})</i>
                        @endif
                        <a class="float-right" href="javascript:void(0)">{{ $string_userMasuk }}</a>
                      </li>
                    @endif
                    @if ($presensiPulang)
                      <li class="list-group-item">
                        Pulang
                        @if ($presensiPulang->_ver > 1)
                          <i class="text-muted"> (Terpindai {{ $presensiPulang->_ver . 'x' }})</i>
                        @endif
                        <a class="float-right" href="javascript:void(0);">{{ $string_userPulang }}</a>
                      </li>
                    @endif
                  @endif
                </ul>
              </div>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-md-9">
            {{-- <div class="callout">
              <h5><i class="far fa-lightbulb fa-sm mr-1"></i> Informasi:</h5>
              Ini adalah data riwayat presensi yang Anda miliki. Terdapat juga jadwal, izin dan cuti milik Anda.
            </div> --}}
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills flex-nowrap overflow-auto" style="white-space: nowrap;">
                  <li class="nav-item"><a class="nav-link active" href="#presensi" data-toggle="tab">Presensi</a></li>
                  <li class="nav-item"><a class="nav-link" href="#jadwal" data-toggle="tab">Jadwal</a></li>
                  <li class="nav-item"><a class="nav-link" href="#perizinan" data-toggle="tab">Izin</a></li>
                  <li class="nav-item"><a class="nav-link" href="#percutian" data-toggle="tab">Cuti</a></li>
                  <li class="nav-item"><a class="nav-link" href="#perdinasan" data-toggle="tab">Dinas</a></li>
                </ul>
              </div>


              <div class="card-body">
                <div class="tab-content">
                  <div class="active tab-pane" id="presensi">
                    <div class="row">
                      <div class="col-lg-12">
                        {{-- Tombol Atas --}}
                        <div class="d-flex flex-wrap justify-content-between">
                          <div class="d-flex flex-wrap justify-content-lg-start">
                            @if (request()->routeIs('presensi.lihat'))
                              <div class="form-group mr-2">
                                <a href="{{ route('presensi.index') }}" class="btn btn-default">
                                  <i class="fas fa-chevron-left mr-1"></i>Kembali</a>
                              </div>
                            @endif
                            <div class="form-group mr-2">
                              <div class="input-group">
                                <button type="button" class="btn btn-default text-nowrap" id="daterange-btn">
                                  @if (request()->has('start_date') && request()->has('end_date'))
                                    @php
                                      $startDate = \Carbon\Carbon::parse(request()->start_date)->translatedFormat(
                                          'd M Y',
                                      );
                                      $endDate = \Carbon\Carbon::parse(request()->end_date)->translatedFormat('d M Y');
                                    @endphp
                                    @if ($startDate === $endDate)
                                      <span id="selected-date-range1">Tanggal: <b>{{ $startDate }}</b></span>
                                    @else
                                      <span id="selected-date-range1">Tanggal: <b> {{ $startDate }}</b> sd.
                                        <b>{{ $endDate }}</b></span>
                                    @endif
                                  @else
                                    <i class="fas fa-calendar-days mr-2"></i>Filter tanggal<span id="selected-date-range1"></span>
                                  @endif
                                  <i class="fas fa-caret-down"></i>
                                </button>
                              </div>
                            </div>
                          </div>

                          <div class="d-flex justify-content-lg-end">
                            @if (request()->routeIs(['presensi.lihat', 'presensi.pribadi']))
                              <div class="form-group ">
                                <div class="input-group">
                                  <button type="button" class="btn btn-primary" id="cetakButton" data-toggle="tooltip"
                                    data-placement="top" title="Cetak laporan presensi">
                                    Cetak<i class="fas fa-print ml-1"></i>
                                  </button>
                                </div>
                              </div>
                            @endif
                          </div>
                        </div>
                        {{-- Tabel Presensi --}}
                        <table id="table_presensi" class="table table-hover">
                          <thead>
                            <tr>
                              <th style="width: 1px;">No.</th>
                              <th class="text-center">Tanggal</th>
                              <th>Waktu</th>
                              <th>Terpindai</th>
                              <th>IP</th>
                              <th>Finger</th>
                              <th>Status</th>
                            </tr>
                          </thead>
                        </table>
                      </div>
                    </div>
                  </div>

                  <div class="tab-pane" id="jadwal">
                    <div class="row">
                      @if ($jadwal)
                        {{-- @php echo $jadwal @endphp --}}
                        <div class="col-lg-12">
                          {{-- tabel --}}
                          <div style="overflow-x: auto;">
                            <table id="table_jadwal" class="table table-hover">
                              <thead>
                                <tr>
                                  <th class="text-center">No.</th>
                                  <th class="text-left">Hari</th>
                                  <th class="text-center">Jadwal</th>
                                  <th class="text-center">Shift</th>
                                  <th class="text-center">Masuk</th>
                                  <th class="text-center">Pulang</th>
                                </tr>
                              </thead>
                              <tbody>
                                @php $n = 0; @endphp
                                @foreach ($jadwal as $index => $jadwal)
                                  @php
                                    $namaHari = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
                                  @endphp
                                  <tr>
                                    <td class="text-center" style="width: 1%">{{ $index + 1 }}</td>
                                    <td style="width: 10%">{{ $namaHari[$jadwal->index_hari] }}</td>
                                    <td style="width: 30%">{!! $jadwal->jadwal[0]->nama_jadwal ? $jadwal->jadwal[0]->nama_jadwal : '<em>(Tidak ada data)</em>' !!}</td>
                                    <td class="text-center">
                                      <span class="{{ $jadwal->jadwal[0]->shift === 'normal' ? 'text-success' : '' }}">
                                        {{ $jadwal->jadwal[0]->shift === 'normal' ? 'Normal' : 'Malam' }}
                                      </span>
                                    </td>
                                    <td class="text-center">{{ date('H:i', strtotime($jadwal->jadwal[0]->jam_masuk)) }}
                                    </td>
                                    <td class="text-center">{{ date('H:i', strtotime($jadwal->jadwal[0]->jam_pulang)) }}
                                    </td>
                                  </tr>
                                @endforeach
                              </tbody>
                            </table>
                          </div>
                        </div>
                      @else
                        Pengguna tidak memiliki jadwal.
                      @endif
                    </div>
                  </div>

                  <div class="tab-pane" id="perizinan">
                    <div class="row">
                      <div class="col-lg-12">
                        {{-- Data perizinan pengguna --}}
                        <div style="overflow-x: auto;">
                          <table id="table_izin" class="table table-hover">
                            <thead>
                              <tr>
                                <th style="width: 1px">No.</th>
                                <th>Nama</th>
                                <th>Hari Tanggal</th>
                                <th>Diajukan</th>
                                <th>Keperluan</th>
                                <th>Status</th>
                              </tr>
                            </thead>

                            <tbody>
                              @foreach ($perizinanPribadi as $index => $izin)
                                <tr>
                                  <td style="width: 1%">{{ $index + 1 }}</td>
                                  <td><a href="/perizinan/{{ $izin->izin_id }}" class="text-decoration-none text-dark"
                                      data-toggle="tooltip" data-placement="top" title="Lihat"><b>
                                        {{ $izin->pengguna[0]->nama }} </b></a>
                                  </td>
                                  <td style="width: 10%" class="text-nowrap">
                                    {{ Carbon::parse($izin->tanggal_ajuan)->translatedFormat('l, d F Y') }}</td>
                                  <td>{{ Carbon::parse($izin->tanggal_ajuan)->diffForHumans() }}</td>
                                  @php
                                    $izinKeperluan = [
                                        'sakit' => 'Izin Sakit',
                                        'terlambat' => 'Izin Terlambat',
                                        'tdk_masuk' => 'Izin Tidak Masuk',
                                        'keluar_smt' => 'Izin Keluar Sementara',
                                        'umroh' => 'Izin Umroh',
                                        'lainnya' => 'Izin Lainnya',
                                    ];
                                  @endphp

                                  <td>
                                    {{ $izinKeperluan[$izin->keperluan_izin] ?? 'Tidak ada data' }}
                                  </td>
                                  <td style="width: 5%" class="text-center">
                                    {{-- {{ $izin->status == Perizinan::DI_AJUKAN ? 'Pengajuan' : ($izin->status == Perizinan::DI_IZINKAN ? 'Diizinkan' : 'Eror') }} --}}
                                    @if ($izin->status == Perizinan::DI_AJUKAN)
                                      <p class="px-2 text-center text-nowrap badge-outline-secondary">
                                        <i class="ion ion-android-radio-button-on mr-1"></i>Pengajuan
                                      </p>
                                    @elseif ($izin->status == Perizinan::DI_IZINKAN)
                                      <p class="px-2 text-center text-nowrap badge-outline-primary">
                                        <i class="ion ion-android-done mr-1"></i>Diizinkan
                                      </p>
                                    @elseif ($izin->status == Perizinan::DI_TOLAK)
                                      <p class="px-2 text-center text-nowrap badge-outline-danger">
                                        <i class="ion ion-android-close mr-1"></i>Ditolak
                                      </p>
                                    @elseif ($izin->status == Perizinan::DI_BATALKAN)
                                      <p class="px-2 text-center text-nowrap badge-outline-secondary">
                                        <i class="ion ion-android-remove-circle mr-1"></i>Dibatalkan
                                      </p>
                                    @endif
                                  </td>
                                </tr>
                              @endforeach
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="tab-pane" id="percutian">
                    <div class="row">
                      <div class="col-lg-12">
                        {{-- Data perizinan pengguna --}}
                        <div style="overflow-x: auto;">
                          <table id="table_cuti" class="table table-hover">
                            <thead>
                              <tr>
                                <th style="width: 1px">No.</th>
                                <th>Nama</th>
                                <th>Hari Tanggal</th>
                                <th>Diajukan</th>
                                <th>Kategori</th>
                                <th>Status</th>
                              </tr>
                            </thead>

                            <tbody>
                              @foreach ($percutianPribadi as $index => $cuti)
                                <tr>
                                  <td style="width: 1%">{{ $index + 1 }}</td>
                                  <td>
                                    <a href="/percutian/{{ $cuti->cuti_id }}" class="text-decoration-none text-dark"
                                      data-toggle="tooltip" data-placement="top" title="Lihat"><b>
                                        {{ $cuti->pengguna[0]->nama }} </b></a>
                                  </td>
                                  <td style="width: 10%" class="text-nowrap">
                                    {{ Carbon::parse($cuti->tanggal_ajuan)->translatedFormat('l, d F Y') }}</td>
                                  <td>{{ Carbon::parse($cuti->tanggal_ajuan)->diffForHumans() }}</td>
                                  <td>{{ $cuti->kateg_cuti[0]->jenis_cuti }} </td>
                                  <td style="width: 5%" class="text-center">
                                    @if ($cuti->status == Percutian::DI_AJUKAN)
                                      <p class="px-2 text-center text-nowrap badge-outline-secondary">
                                        <i class="ion ion-android-radio-button-on mr-1"></i>Pengajuan
                                      </p>
                                    @elseif ($cuti->status == Percutian::DI_SETUJUI_PIMPINAN)
                                      <p class="px-2 text-center text-nowrap badge-outline-primary">
                                        <i class="ion ion-android-done-all mr-1"></i>Disetujui Pimpinan
                                      </p>
                                    @elseif ($cuti->status == Percutian::DI_IZINKAN_ATASAN)
                                      <p class="px-2 text-center text-nowrap badge-outline-secondary">
                                        <i class="ion ion ion-android-done mr-1"></i>Diizinkan Atasan
                                      </p>
                                    @elseif ($cuti->status == Percutian::DI_TOLAK)
                                      <p class="px-2 text-center text-nowrap badge-outline-danger">
                                        <i class="ion ion-android-close mr-1"></i>Ditolak
                                      </p>
                                    @elseif ($cuti->status == Percutian::DI_BATALKAN)
                                      <p class="px-2 text-center text-nowrap badge-outline-secondary">
                                        <i class="ion ion-android-remove-circle mr-1"></i>Dibatalkan
                                      </p>
                                    @endif
                                  </td>
                                </tr>
                              @endforeach
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="tab-pane" id="perdinasan">
                    <div class="row">
                      <div class="col-lg-12">
                        {{-- Data perizinan pengguna --}}
                        <div style="overflow-x: auto;">
                          <table id="table_dinas" class="table table-hover">
                            <thead>
                              <tr>
                                <th style="width: 1px">No.</th>
                                <th>Nama</th>
                                <th>Hari Tanggal</th>
                                <th>Diajukan</th>
                                <th>Kategori</th>
                                <th>Status</th>
                              </tr>
                            </thead>

                            <tbody>
                              @foreach ($perdinasanPribadi as $index => $dinas)
                                <tr>
                                  <td style="width: 1%">{{ $index + 1 }}</td>
                                  <td>
                                    <a href="/perdinasan/{{ $dinas->dinas_id }}" class="text-decoration-none text-dark"
                                      data-toggle="tooltip" data-placement="top" title="Lihat"><b>
                                        {{ $dinas->pengguna[0]->nama }} </b></a>
                                  </td>
                                  <td style="width: 10%" class="text-nowrap">
                                    {{ Carbon::parse($dinas->tanggal_ajuan)->translatedFormat('l, d F Y') }}</td>
                                  <td>{{ Carbon::parse($dinas->tanggal_ajuan)->diffForHumans() }}</td>
                                  <td>{{ $dinas->kateg_dinas[0]->jenis_dinas }} </td>
                                  <td style="width: 5%" class="text-center">
                                    @if ($dinas->status == Percutian::DI_AJUKAN)
                                      <p class="px-2 text-center text-nowrap badge-outline-secondary">
                                        <i class="ion ion-android-radio-button-on mr-1"></i>Pengajuan
                                      </p>
                                    @elseif ($dinas->status == Percutian::DI_SETUJUI_PIMPINAN)
                                      <p class="px-2 text-center text-nowrap badge-outline-primary">
                                        <i class="ion ion-android-done-all mr-1"></i>Disetujui Pimpinan
                                      </p>
                                    @elseif ($dinas->status == Percutian::DI_TOLAK)
                                      <p class="px-2 text-center text-nowrap badge-outline-danger">
                                        <i class="ion ion-android-close mr-1"></i>Ditolak
                                      </p>
                                    @elseif ($dinas->status == Percutian::DI_BATALKAN)
                                      <p class="px-2 text-center text-nowrap badge-outline-secondary">
                                        <i class="ion ion-android-remove-circle mr-1"></i>Dibatalkan
                                      </p>
                                    @endif
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
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection

@section('js_atas')
  {{-- daterange picker --}}
  <link rel="stylesheet" href="{{ asset('css/back/daterangepicker.css') }}">
  <link rel="stylesheet" href="{{ asset('css/back/bootstrap-colorpicker.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css/back/tempusdominus-bootstrap-4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css/back/select2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css/back/select2-bootstrap4.min.css') }}">
@endsection

@section('style')
  <style>
    .nav-pills .nav-link.active,
    .nav-pills .show>.nav-link {
      color: #fff;
      background-color: slategrey;
    }

    .no-select::selection,
    .no-select *::selection {
      background-color: Transparent;
    }

    .no-select {
      /* Sometimes I add this too. */
      cursor: default;
    }

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
      /* color: rgb(117, 117, 117); */
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
  <script src="{{ asset('js/plugins/sparkline.js') }}"></script>

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

    //MULAI DATATABLE
    //script untuk memanggil data json dari server dan menampilkannya berupa datatable
    $(document).ready(function() {
      var currentUrl = window.location.href;
      var idRegex = /presensi\/lihat\/(\d+)/;
      var matches = currentUrl.match(idRegex);
      var currentId = matches ? matches[1] : null;
      // Mengambil ID dari url

      var startDateRegex = /start_date=(\d{4}-\d{2}-\d{2})/;
      var endDateRegex = /end_date=(\d{4}-\d{2}-\d{2})/;
      var startDateMatches = currentUrl.match(startDateRegex);
      var endDateMatches = currentUrl.match(endDateRegex);
      // Mendapatkan nilai start_date dan end_date
      const ambilStartDate = startDateMatches ? startDateMatches[1] : null;
      const ambilEndDate = endDateMatches ? endDateMatches[1] : null;
      // Fungsi untuk memformat tanggal
      const formatDate = (date, defaultDate) => {
        return date ? moment(date).format('YYYY-MM-DD') : moment(defaultDate).format('YYYY-MM-DD');
      };
      // Menentukan tanggal default
      const defaultStartDate = moment().subtract(6, 'days'); // 7 hari yang lalu
      const defaultEndDate = moment(); // Tanggal hari ini
      // Memformat tanggal
      const formattedStartDate = formatDate(ambilStartDate, defaultStartDate);
      const formattedEndDate = formatDate(ambilEndDate, defaultEndDate);

      $('#table_presensi').DataTable({
        info: true,
        autoWidth: false, //mengatur lebar width pada table otomatis //set to false
        colReorder: true, // Aktifkan ColReorder untuk tabel
        scrollX: true,
        lengthChange: true, //apakah jumlah row statik atau bisa berubah
        lengthMenu: [
          [15, 50, 100, -1],
          [15, 50, 100, "Semua"]
        ], //jumlah data yang ditampilkan

        processing: true,
        deferRender: true,
        serverSide: true, //aktifkan server-side

        processing: true,
        deferRender: true,
        serverSide: true, //aktifkan server-side
        ajax: {
          // url: "{{ route('presensi.lihat') }}",
          @if (request()->routeIs('presensi.lihat'))
            url: "{{ route('presensi.lihat', ['id' => ':id']) }}".replace(':id', currentId),
          @elseif (request()->routeIs('presensi.pribadi'))
            url: "{{ route('presensi.pribadi') }}",
          @endif
          data: {
            start_date: ambilStartDate,
            end_date: ambilEndDate
          },
          type: 'GET'
        },
        search: {
          "regex": true
        },
        columns: [{
            data: null,
            sortable: true,
            className: "text-center text-nowrap",
            render: function(data, type, row, meta) {
              return meta.row + meta.settings._iDisplayStart + 1;
            }
          },
          {
            data: 'tanggalPresensi',
            name: 'tanggalPresensi',
            className: "text-nowrap"
          },
          {
            data: 'waktuPresensi',
            name: 'waktuPresensi',
            className: "text-center text-nowrap"
          },
          {
            data: 'terbaca',
            name: 'terbaca',
            className: "text-center text-nowrap"
          },
          {
            data: 'ip',
            name: 'ip',
            className: "text-center text-nowrap"
          },
          {
            data: 'finger',
            name: 'finger',
            className: "text-center text-nowrap no-select"
          },
          {
            data: 'status',
            name: 'status',
            className: "text-center text-nowrap"
          }
        ],
        ordering: false,

        language: {
          "processing": "Memproses data...",
          "loadingRecords": "Masih memproses...",
          "lengthMenu": "Tampil _MENU_",
          "zeroRecords": "Data tidak ditemukan",
          "info": "Hal. _PAGE_ dari _PAGES_",
          "infoEmpty": " ",
          "infoFiltered": "(filter dari _MAX_ rekam data)",
          "search": "Cari:",
          "emptyTable": "Belum ada data presensi",
          "thousands": ".",
          "paginate": {
            "first": "Pertama",
            "last": "Terakhir",
            "next": "Next",
            "previous": "Prev"
          },
        },
      });

      $('#table_jadwal').DataTable({
        autoWidth: true, //mengatur lebar width pada table otomatis
        lengthMenu: [
          [15, 30, -1],
          [15, 30, "Semua"]
        ], //jumlah data yang ditampilkan
        search: {
          "regex": true
        },
        ordering: false,
        language: {
          "lengthMenu": "Tampil _MENU_",
          "zeroRecords": "Data tidak ditemukan",
          "info": "Hal. _PAGE_ dari _PAGES_",
          "infoEmpty": " ",
          "infoFiltered": "(terfilter dari _MAX_ data)",
          "search": "Cari:",
          "emptyTable": "Belum memiliki jadwal",
          "thousands": ".",
          "paginate": {
            "first": "Pertama",
            "last": "Terakhir",
            "next": "Next",
            "previous": "Prev"
          },
        },
      });

      $('#table_izin').DataTable({
        // info: true,
        autoWidth: true, //mengatur lebar width pada table otomatis
        // scrollX: true,
        lengthChange: true, //apakah jumlah row statik atau bisa berubah
        lengthMenu: [
          [15, 30, -1],
          [15, 30, "Semua"]
        ], //jumlah data yang ditampilkan
        processing: true,
        ordering: false,
        language: {
          "processing": "Memproses data...",
          "loadingRecords": "Masih memproses...",
          "lengthMenu": "Tampil _MENU_",
          "zeroRecords": "Data tidak ditemukan",
          "info": "Hal. _PAGE_ dari _PAGES_",
          "infoEmpty": " ",
          "infoFiltered": "(filter dari _MAX_ rekam data)",
          "search": "Cari:",
          "emptyTable": "Belum ada perizinan",
          "thousands": ".",
          "paginate": {
            "first": "Pertama",
            "last": "Terakhir",
            "next": "Next",
            "previous": "Prev"
          },
        },
      });

      $('#table_cuti').DataTable({
        // info: true,
        autoWidth: true, //mengatur lebar width pada table otomatis
        // scrollX: true,
        lengthChange: true, //apakah jumlah row statik atau bisa berubah
        lengthMenu: [
          [15, 30, -1],
          [15, 30, "Semua"]
        ], //jumlah data yang ditampilkan
        processing: true,
        ordering: false,
        language: {
          "processing": "Memproses data...",
          "loadingRecords": "Masih memproses...",
          "lengthMenu": "Tampil _MENU_",
          "zeroRecords": "Data tidak ditemukan",
          "info": "Hal. _PAGE_ dari _PAGES_",
          "infoEmpty": " ",
          "infoFiltered": "(filter dari _MAX_ rekam data)",
          "search": "Cari:",
          "emptyTable": "Belum ada pengajuan cuti",
          "thousands": ".",
          "paginate": {
            "first": "Pertama",
            "last": "Terakhir",
            "next": "Next",
            "previous": "Prev"
          },
        },
      });

      $('#table_dinas').DataTable({
        // info: true,
        autoWidth: true, //mengatur lebar width pada table otomatis
        // scrollX: true,
        lengthChange: true, //apakah jumlah row statik atau bisa berubah
        lengthMenu: [
          [15, 30, -1],
          [15, 30, "Semua"]
        ], //jumlah data yang ditampilkan
        processing: true,
        ordering: false,
        language: {
          "processing": "Memproses data...",
          "loadingRecords": "Masih memproses...",
          "lengthMenu": "Tampil _MENU_",
          "zeroRecords": "Data tidak ditemukan",
          "info": "Hal. _PAGE_ dari _PAGES_",
          "infoEmpty": " ",
          "infoFiltered": "(filter dari _MAX_ rekam data)",
          "search": "Cari:",
          "emptyTable": "Belum ada tugas dinas",
          "thousands": ".",
          "paginate": {
            "first": "Pertama",
            "last": "Terakhir",
            "next": "Next",
            "previous": "Prev"
          },
        },
      });

      // Initialize date range picker
      $('#daterange-btn').daterangepicker({
        startDate: formattedStartDate,
        endDate: formattedEndDate,
        locale: {
          format: 'YYYY-MM-DD', // Set the desired date format here
          separator: ' sampai ',
          applyLabel: 'Terapkan',
          cancelLabel: 'Batalkan',
          fromLabel: 'Dari',
          toLabel: 'Ke',
          customRangeLabel: 'Kostum',
          weekLabel: 'W',
          daysOfWeek: ['Min', 'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab'],
          monthNames: [
            'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
          ],
          firstDay: 1
        },
        ranges: {
          'Hari ini': [moment(), moment()],
          'Kemarin': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          '7 hari terakhir': [moment().subtract(6, 'days'), moment()],
          '30 hari terakhir': [moment().subtract(29, 'days'), moment()],
          'Bulan ini': [moment().startOf('month'), moment().endOf('month')],
          'Bulan kemarin': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf(
            'month')]
        },
      }, function(start, end) {
        // Update the selected date range display
        $('#selected-date-range1').text('Tanggal: ' + start.format('DD MMM YYYY') + ' sd. ' + end.format(
          'DD MMM YYYY'));
        // Update tombol dengan rentang tanggal yang dipilih
        $('#daterange-btn span').html('Tanggal: ' +start.format('DD MMM YYYY') + ' sd. ' + end.format('DD MMM YYYY'));

        try {
          // Redirect to the new URL with start_date and end_date as query parameters
          @if (request()->routeIs('presensi.lihat'))
            let getUrl = "{{ route('presensi.lihat', ['id' => ':id']) }}".replace(':id', currentId);
          @elseif (request()->routeIs('presensi.pribadi'))
            let getUrl = "{{ route('presensi.pribadi') }}";
          @endif
          var theUrl = getUrl +
            '?start_date=' + encodeURIComponent(start.format('YYYY-MM-DD')) +
            '&end_date=' + encodeURIComponent(end.format('YYYY-MM-DD'));
          window.location.href = theUrl;
        } catch (error) {
          console.error("Terjadi kesalahan saat memproses filterisasi:", error);
          // Handle the error as needed, e.g., display an alert to the user
          alert("Terjadi kesalahan saat memproses filterisasi. Mohon dicoba kembali.");
        }
      });

      // Script untuk filter dan DataTable tetap seperti sebelumnya
      $('#cetakButton').click(function() {
        try {
          // Cek apakah daterangepicker ada
          var daterangepicker = $('#daterange-btn').data('daterangepicker');
          if (!daterangepicker) {
            throw new Error('DateRangePicker tidak diinisialisasi.');
          }
          // Ambil nilai tanggal dari DateRangePicker
          var startDate = ambilStartDate;
          var endDate = ambilEndDate;
          // Redirect ke URL cetak dengan parameter tanggal
          var printURL = '{{ route('presensi.cetak') }}' +
            '?start_date=' + encodeURIComponent(startDate) +
            '&end_date=' + encodeURIComponent(endDate);
          window.open(printURL, '_blank');
        } catch (error) {
          console.error("Terjadi kesalahan saat memproses pencetakan:", error.message);
          alert("Terjadi kesalahan saat mencoba mencetak. Silakan ulangi.");
        }
      });
    });

    // Selesaikan NProgress saat AJAX request selesai dan gambar-gambar dalam tabel telah dimuat
    $(document).ajaxComplete(function(event, xhr, settings) {
      const $container = $(
        '#table_presensi, #table_jadwal, #table_izin, #table_cuti, #table_dinas'
      ); // Gantilah dengan selector tabel Anda
      stopLoadingWhenImagesLoaded($container);
    });
  </script>
@endsection
