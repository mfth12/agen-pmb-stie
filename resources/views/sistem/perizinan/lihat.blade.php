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
    @php
      use App\Models\Perizinan;
      use App\Models\Level_pengguna;

      $kosong = '<i>(Tidak ada data)</i>';
    @endphp

    <section class="content">
      <div class="container">
        <div class="row">
          {{-- KOLOM KIRI --}}
          <div class="col-md-7">
            {{-- JIKA DIAJUKAN --}}
            {{-- JIKA DIAJUKAN --}}
            @if ($perizinan->status == Perizinan::DI_AJUKAN)
              @if (in_array(auth()->user()->role, [Level_pengguna::IS_SUPERADMIN, Level_pengguna::IS_MANAGER]))
                {{-- Untuk superadmin dan manager --}}
                <div class="callout callout-info alert alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <i class="fa fa-info-circle mr-2"></i>Pengajuan izin ini menunggu persetujuan dari Atasan
                  {{ $ketuaunit->user_id ? "($ketuaunit->nama)" : '' }}
                </div>
              @elseif (auth()->user()->role == Level_pengguna::IS_ATASAN)
                {{-- Untuk atasan --}}
                @if ($perizinan->pengguna_id == auth()->user()->user_id)
                  {{-- Jika Pengajuan sendiri dan dia atasan juga --}}
                  <div class="callout callout-info alert alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <i class="fa fa-info-circle mr-2"></i>Pengajuan izin Anda menunggu persetujuan dari Atasan
                    {{ $ketuaunit->user_id ? "($ketuaunit->nama)" : '' }} <br>
                    <a href="javascript:void(0)" onclick="" class="btn btn-sm btn-info mt-2 "
                      style="text-decoration: none">Hubungi<i class="fa-brands fa-whatsapp fa-lg ml-1"></i>
                    </a>
                  </div>
                @elseif($ketuaunit->user_id == auth()->user()->user_id)
                  {{-- Jika Atasan langsung --}}
                  <div class="callout callout-info alert alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <i class="fa fa-info-circle mr-2"></i>Pengajuan izin ini membutuhkan persetujuan Anda
                  </div>
                @endif
              @elseif (auth()->user()->role == Level_pengguna::IS_PEGAWAI)
                {{-- Untuk pegawai --}}
                {{-- Sama seperti yang atasan, dan dia atasan --}}
                <div class="callout callout-info alert alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <i class="fa fa-info-circle mr-2"></i> Pengajuan izin Anda menunggu persetujuan dari Atasan
                  {{ $ketuaunit->user_id ? "($ketuaunit->nama)" : '' }} <br>
                  <a href="javascript:void(0)" onclick="" class="btn btn-sm btn-info mt-2"
                    style="text-decoration: none">Hubungi<i class="fa-brands fa-whatsapp fa-lg ml-1"></i>
                  </a>
                </div>
              @endif

              {{-- JIKA DISETUJUI ATASAN --}}
              {{-- JIKA DISETUJUI ATASAN --}}
            @elseif ($perizinan->status == Perizinan::DI_IZINKAN)
              @if (in_array(auth()->user()->role, [Level_pengguna::IS_SUPERADMIN, Level_pengguna::IS_MANAGER]))
                {{-- ANDA ADALAH SUPERADMIN dan MANAGER --}}
                <div class="callout callout-success alert alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <i class="fas fa-circle-check mr-2"></i>Pengajuan izin ini telah disetujui Atasan
                </div>
              @elseif ($perizinan->izin_dari == auth()->user()->user_id)
                {{-- Jika atasan yang bersangkutan --}}
                <div class="callout callout-success alert alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <i class="fas fa-circle-check mr-2"></i>Pengajuan izin ini telah disetujui oleh Anda
                </div>
              @elseif ($perizinan->pengguna_id == auth()->user()->user_id)
                {{-- Jika pengaju --}}
                <div class="callout callout-success alert alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <i class="fas fa-circle-check fa-bounce mr-2"></i><b>Selamat! </b><br>
                  Pengajuan izin Anda telah disetujui Atasan
                </div>
              @else
                {{-- Harus kosong --}}
              @endif

              {{-- JIKA DITOLAK --}}
              {{-- JIKA DITOLAK --}}
            @elseif ($perizinan->status == Perizinan::DI_TOLAK)
              {{-- Semua jenis user yang melihat --}}
              <div class="callout callout-danger alert alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <i class="fas fa-triangle-exclamation mr-2"></i>Pengajuan izin ditolak oleh
                {{ $perizinan->izin_oleh[0]->user_id == auth()->user()->user_id ? 'Anda' : $perizinan->izin_oleh[0]->nama }}
              </div>
            @else
              {{-- Masih kosong --}}
            @endif
            <div class="card card-default">
              <div class="card-body">
                <table class="table table-sm table-borderless">
                  <tr>
                    <td style="width: 35%; vertical-align: middle;"><b>Status</b></td>
                    <td style="vertical-align: middle">:
                      @switch($perizinan->status)
                        @case(Perizinan::DI_IZINKAN)
                          <p class="badge badge-success mb-0" style=" font-size: 100%;font-weight:400;">
                            <i class="ion ion-android-done mx-1"></i>
                            Diizinkan
                          </p>
                        @break

                        @case(Perizinan::DI_AJUKAN)
                          <p class="badge badge-secondary mb-0" style=" font-size: 100%;font-weight:400;">
                            <i class="ion ion-android-radio-button-on mx-1"></i>
                            Pengajuan
                          </p>
                        @break

                        @case(Perizinan::DI_TOLAK)
                          <p class="badge badge-danger mb-0" style=" font-size: 100%;font-weight:400;">
                            <i class="ion ion-android-close mx-1"></i>
                            Ditolak
                          </p>
                        @break

                        @case(Perizinan::DI_BATALKAN)
                          <p class="badge badge-secondary mb-0" style=" font-size: 100%;font-weight:400;">
                            <i class="ion ion-android-remove-circle mx-1"></i>
                            Dibatalkan
                          </p>
                        @break

                        @default
                          Status Tidak Diketahui
                      @endswitch
                    </td>
                  </tr>
                  <tr>
                    <td style="width: 35%"><b>Nama</b></td>
                    <td>: {!! $perizinan->pengguna[0]->nama !!}</td>
                  </tr>
                  <tr>
                    <td style="width: 35%"><b>NPPY</b></td>
                    <td>: {!! $perizinan->pengguna[0]->nomer_induk ?? $kosong !!}</td>
                  </tr>
                  <tr>
                    <td style="width: 35%"><b>Pengajuan</b></td>
                    <td>: {!! Carbon\Carbon::parse($perizinan->tanggal_ajuan)->isoFormat('dddd, D MMMM Y [pukul] HH:mm') ?? $kosong !!}
                    </td>
                  </tr>
                </table>
                <hr>
                <table class="table table-sm table-borderless">
                  <tr>
                    <td style="width: 35%;"><b>Keperluan</b></td>
                    <td>:
                      {{ match ($perizinan->keperluan_izin) {
                          'sakit' => 'Izin Sakit',
                          'terlambat' => 'Izin Terlambat',
                          'tdk_masuk' => 'Izin Tidak Masuk',
                          'keluar_smt' => 'Izin Keluar Sementara',
                          'umroh' => 'Izin Umroh',
                          'lainnya' => 'Izin Lainnya',
                          default => '--Terjadi kesalahan--',
                      } }}
                    </td>
                  </tr>
                  <tr>
                    <td style="width: 35%;"><b>Tanggal</b></td>
                    <td>: {!! Carbon\Carbon::parse($perizinan->tanggal_izin_awal)->isoFormat('dddd, D MMMM Y') ?? $kosong !!}
                  </tr>
                  <tr>
                    <td style="width: 35%;"><b>Sampai</b></td>
                    <td>: {!! Carbon\Carbon::parse($perizinan->tanggal_izin_akhir)->isoFormat('dddd, D MMMM Y') ?? $kosong !!}</td>
                  </tr>
                  <tr>
                    <td style="width: 35%;"><b>Lama</b></td>
                    <td>: {!! $perizinan->berapa_lama ?? $kosong !!}</td>
                  </tr>
                  <tr>
                    <td style="width: 35%;"><b>Alasan Izin</b></td>
                    <td>: {!! $perizinan->alasan ?? $kosong !!}</td>
                  </tr>

                  @if ($perizinan->bukti != null)
                    <tr>
                      <td style="width: 35%;"><b>Lampiran</b></td>
                      <td>:
                        <span class="text-primary">
                          <a href="/storage/{!! $perizinan->bukti !!}" target="_blank">Lihat gambar/berkas</a>
                      </td>
                      </p>
                    </tr>
                  @endif
                </table>

                @if ($perizinan->status == Perizinan::DI_BATALKAN)
                  <hr>
                  <table class="table table-sm table-borderless">
                    <tr>
                      <td style="width: 35%;"><b>Alasan Batal</b></td>
                      <td>: {!! $perizinan->pesan ?? $kosong !!}</td>
                    </tr>
                  </table>
                @endif

                <input type="hidden" id="alasan_izin" value="{{ $perizinan->alasan ?? $kosong }}">
                <input type="hidden" id="tanggal_izin_awal"
                  value="{{ Carbon\Carbon::parse($perizinan->tanggal_izin_awal)->isoFormat('dddd, D MMMM Y') ?? $kosong }}">
                <input type="hidden" id="tanggal_izin_akhir"
                  value="{{ Carbon\Carbon::parse($perizinan->tanggal_izin_akhir)->isoFormat('dddd, D MMMM Y') ?? $kosong }}">
              </div>

            </div>
          </div>
          {{-- KOLOM KANAN --}}
          <div class="col-md-5">

            {{-- Atasan Langsung --}}
            {{-- Atasan Langsung --}}
            {{-- Atasan Langsung --}}
            <div class="card card-default">
              <div class="card-body" style="padding-bottom: 0em">
                <strong class="mr-1"><i class="fas fa-user-tie mr-2"></i>Atasan Langsung</strong>
                <span class="text-nowrap">
                  @if ($ketuaunit->user_id == auth()->user()->user_id)
                    <span class="text-center badge-outline-aktif">
                      Anda</span>
                  @endif
                  @if ($ketuaunit->user_id == $perizinan->izin_dari && $perizinan->status == Perizinan::DI_TOLAK)
                    <span class="text-center badge-outline-merah">
                      Menolak</span>
                  @endif
                  <p class="text-muted">{{ $ketuaunit->nama }}
                    <br>{{ 'NPPY. ' . $ketuaunit->nomer_induk }}
                  </p>
                </span>

                {{-- UNTUK TERIZIN DARI ATASAN --}}
                @if (
                    $perizinan->pesan != null && //jika percutian ada pesannya &
                        in_array($perizinan->status, [
                            //jika memiliki status berikut
                            Perizinan::DI_IZINKAN,
                            Perizinan::DI_TOLAK,
                        ]))
                  <hr>
                  <div class="row">
                    <div class="col-md-6">
                      <strong>Pesan</strong>
                      <p class="text-muted">{{ $perizinan->pesan }}</p>
                    </div>
                    <div class="col-md-6">
                      <strong>TTD</strong>
                      @if ($perizinan->izin_dari == $ketuaunit->user_id)
                        <span style="color: rgb(14, 164, 14)">valid
                          <i class="ion ion-checkmark"></i>
                        </span>
                        <p class="text-muted">
                          @if ($perizinan->tgl_izin != null)
                            Disahkan pada
                            {{ \Carbon\Carbon::parse($perizinan->tgl_izin)->translatedFormat('d F Y') }} pukul
                            {{ \Carbon\Carbon::parse($perizinan->tgl_izin)->translatedFormat('H:i') }}
                          @endif
                        </p>
                      @else
                        <span class="text-nowrap" style="color: rgba(0, 0, 0, 0.5)">diwakilkan
                          <i class="ion ion-checkmark"></i>
                        </span>
                        <p class="text-muted">Oleh {{ $perizinan->izin_oleh[0]->nama }}
                          @if ($perizinan->tgl_izin != null)
                            pada
                            {{ \Carbon\Carbon::parse($perizinan->tgl_izin)->translatedFormat('d F Y') }} pukul
                            {{ \Carbon\Carbon::parse($perizinan->tgl_izin)->translatedFormat('H:i') }}
                          @endif
                        </p>
                      @endif
                    </div>
                  </div>
                @endif

                {{-- UNTUK PENOLAKAN OLEH ATASAN --}}
                @if (
                    $perizinan->tolak_pesan != null && //jika ada pesan penolakan &
                        in_array($perizinan->status, [
                            //jika memiliki status berikut
                            Perizinan::DI_TOLAK,
                        ]))
                  @if ($perizinan->izin_dari == $ketuaunit->user_id)
                    {{-- tampilkan hanya jika atasan yang menolak --}}
                    <hr>
                    <div class="row">
                      <div class="col-md-6">
                        <strong>Alasan</strong>
                        <p class="text-muted">{{ $perizinan->tolak_pesan }}</p>
                      </div>
                      <div class="col-md-6">
                        <strong>TTD</strong>
                        @if ($perizinan->izin_dari == $ketuaunit->user_id)
                          <span style="color: rgb(14, 164, 14)">valid
                            <i class="ion ion-checkmark"></i>
                          </span>
                          <p class="text-muted">
                            @if ($perizinan->tgl_izin != null)
                              Pada tanggal
                              {{ \Carbon\Carbon::parse($perizinan->tgl_izin)->translatedFormat('d F Y') }} pukul
                              {{ \Carbon\Carbon::parse($perizinan->tgl_izin)->translatedFormat('H:i') }}
                            @endif
                          </p>
                        @else
                          <span class="text-nowrap" style="color: rgba(0, 0, 0, 0.5)">diwakilkan
                            <i class="ion ion-checkmark"></i>
                          </span>
                          <p class="text-muted">Oleh {{ $perizinan->tolak_oleh[0]->nama }}
                            @if ($perizinan->tgl_izin != null)
                              pada
                              {{ \Carbon\Carbon::parse($perizinan->tgl_izin)->translatedFormat('d F Y') }} pukul
                              {{ \Carbon\Carbon::parse($perizinan->tgl_izin)->translatedFormat('H:i') }}
                            @endif
                          </p>
                        @endif
                      </div>
                    </div>
                  @endif
                @endif
              </div>
            </div>

            {{-- HANYA AKAN DILIHAT OLEH SUPERADMIN DAN MANAGER --}}
            @if (
                $perizinan->status == Perizinan::DI_TOLAK &&
                    in_array(auth()->user()->role, [Level_pengguna::IS_SUPERADMIN, Level_pengguna::IS_MANAGER]))
              @if ($perizinan->tolak_dari != $ketuaunit->user_id)
                <div class="card card-default">
                  <div class="card-body" style="padding-bottom: 0em">
                    <strong class="mb-0 text-danger">
                      <i class="fas fa-triangle-exclamation mr-2"></i>
                      {{ $perizinan->izin_oleh[0]->nama }} Melakukan Penolakan</strong>
                    <div class="row">
                      <div class="col-md-12">
                        <p class="text-muted">Alasan: {{ $perizinan->pesan }}
                          @if ($perizinan->tgl_izin != null)
                            <br>
                            Pada:
                            {{ \Carbon\Carbon::parse($perizinan->tgl_izin)->translatedFormat('d F Y') }} pukul
                            {{ \Carbon\Carbon::parse($perizinan->tgl_izin)->translatedFormat('H:i') }}
                          @endif
                        </p>
                      </div>
                    </div>
                  </div>
                </div>
              @endif
            @endif
            <div class="card">
              <div class="card-header">
                <div class="tombol-aksi">

                  @php
                    use Illuminate\Support\Str;
                    $previousUrl = url()->previous();
                    $targetRoute = '';

                    switch ($previousUrl) {
                        //dari percutian group
                        case route('perizinan.index'):
                            $targetRoute = route('perizinan.index');
                            break;
                        case route('perizinan.diizinkan'):
                            $targetRoute = route('perizinan.diizinkan');
                            break;
                        case route('perizinan.dibatalkan'):
                            $targetRoute = route('perizinan.dibatalkan');
                            break;
                        case route('perizinan.diajukan'):
                            $targetRoute = route('perizinan.diajukan');
                            break;
                        case route('perizinan.ditolak'):
                            $targetRoute = route('perizinan.ditolak');
                            break;
                        // Memeriksa URL dengan parameter ID
                        case Str::is(route('presensi.lihat', ['id' => '*']), $previousUrl):
                            // Mengambil ID dari URL sebelumnya
                            $id = last(explode('/', $previousUrl));
                            $targetRoute = route('presensi.lihat', ['id' => $id]);
                            break;
                        // Kalau sama dengan link sebelumnya
                        case $previousUrl === url()->current():
                            $targetRoute = route('perizinan.index');
                            break;
                        default:
                            $targetRoute = null;
                            break;
                    }
                  @endphp

                  @if ($targetRoute)
                    <a href="{{ $targetRoute }}" class="btn btn-default">
                      <i class="fas fa-chevron-left mr-1"></i>Kembali
                    </a>
                  @endif


                  {{-- JIKA DIAJUKAN --}}
                  {{-- JIKA DIAJUKAN --}}
                  @if ($perizinan->status == Perizinan::DI_AJUKAN)
                    @if (in_array(auth()->user()->role, [Level_pengguna::IS_SUPERADMIN, Level_pengguna::IS_MANAGER]))
                      {{-- Untuk superadmin dan manager --}}
                      {{-- Untuk superadmin dan manager --}}
                      <a href="javascript:void(0)" onclick="fn_confirm_terima('/')" id="tombol-terima"
                        class="btn btn-info float-right ml-2">Terima
                        <i class="ion ion-android-done"></i>
                      </a>
                      <a href="javascript:void(0)" onclick="fn_confirm_tolak('/')" id="tombol-tolak"
                        class="btn btn-secondary float-right">Tolak
                        <i class="ion ion-android-close ml-1"></i>
                      </a>
                    @elseif (auth()->user()->role == Level_pengguna::IS_ATASAN)
                      {{-- Untuk atasan --}}
                      {{-- Untuk atasan --}}
                      @if (auth()->user()->role == Level_pengguna::IS_ATASAN && $perizinan->pengguna_id == auth()->user()->user_id)
                        {{-- Jika Pengajuan sndiri dan dia atasan juga --}}
                        <div class="btn-group float-right">
                          <a href="javascript:void(0)" onclick="fn_kirim_wa('{{ $ketuaunit->detail->nomer_wa }}')"
                            type="button" class="btn btn-md btn-default">Hubungi
                            <i class="fa-brands fa-whatsapp fa-lg ml-2"></i>
                          </a>
                          <a href="" type="button" class="btn btn-md btn-default dropdown-toggle dropdown-icon"
                            data-toggle="dropdown">
                            <span class="sr-only">Toggle Dropdown</span>
                          </a>
                          <div class="dropdown-menu dropdown-menu-right" role="menu">
                            <a class="dropdown-item batalkan" href="javascript:void(0)"
                              onclick="fn_confirm_batal('/')"><i class="fa-solid fa-ban mr-1"></i>Batalkan
                            </a>
                          </div>
                        </div>
                      @elseif(auth()->user()->role == Level_pengguna::IS_ATASAN && $ketuaunit->user_id == auth()->user()->user_id)
                        {{-- Jika Atasan langsung --}}
                        <a href="javascript:void(0)" onclick="fn_confirm_terima('/')" id="tombol-terima"
                          class="btn btn-info float-right ml-2">Terima
                          <i class="ion ion-android-done ml-1"></i>
                        </a>
                        <a href="javascript:void(0)" onclick="fn_confirm_tolak('/')" id="tombol-tolak"
                          class="btn btn-secondary float-right">Tolak
                          <i class="ion ion-android-close ml-1"></i>
                        </a>
                      @endif
                    @elseif (auth()->user()->role == Level_pengguna::IS_PEGAWAI)
                      {{-- Untuk pegawai --}}
                      <div class="btn-group float-right">
                        <a href="javascript:void(0)" onclick="fn_kirim_wa('{{ $ketuaunit->detail->nomer_wa }}')"
                          type="button" class="btn btn-md btn-default">Hubungi
                          <i class="fa-brands fa-whatsapp fa-lg ml-2"></i>
                        </a>
                        <a href="" type="button" class="btn btn-md btn-default dropdown-toggle dropdown-icon"
                          data-toggle="dropdown">
                          <span class="sr-only">Toggle Dropdown</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" role="menu">
                          <a class="dropdown-item batalkan" href="javascript:void(0)" onclick="fn_confirm_batal('/')">
                            <i class="fa-solid fa-ban mr-1"></i>Batalkan
                          </a>
                        </div>
                      </div>
                    @endif

                    {{-- JIKA DIIZINKAN_ATASAN --}}
                    {{-- JIKA DIIZINKAN_ATASAN --}}
                  @elseif ($perizinan->status == Perizinan::DI_IZINKAN)
                    @if (in_array(auth()->user()->role, [Level_pengguna::IS_SUPERADMIN, Level_pengguna::IS_MANAGER]))
                      <a onclick="window.print()" class="btn btn-primary float-right ml-2">Cetak
                        <i class="fas fa-print ml-1"></i>
                      </a>
                    @elseif ($perizinan->izin_dari == auth()->user()->user_id)
                      {{-- Jika atasan yang bersangkutan --}}
                      {{-- kosong --}}
                    @elseif ($perizinan->pengguna_id == auth()->user()->user_id)
                      {{-- Jika pengaju --}}
                      <a onclick="window.print()" class="btn btn-primary float-right ml-2">Cetak
                        <i class="fas fa-print ml-1"></i>
                      </a>
                    @else
                      {{-- Harus kosong --}}
                    @endif
                  @else
                    {{-- Masih kosong --}}
                  @endif
                </div>
              </div>
            </div>
          </div>
          {{-- AKHIR KOLOM KANAN --}}
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
    .badge-outline-aktif {
      text-align: center;
      background-color: transparent;
      /* border-color: #6c757d; */
      border: 1px solid;
      border-radius: 1rem;
      padding: 0.01em 0.7em;
      color: rgb(8, 151, 8);
    }

    .badge-outline-pasif {
      text-align: center;
      background-color: transparent;
      /* border-color: #6c757d; */
      border: 1px solid;
      border-radius: 1rem;
      padding: 0.01em 0.7em;
      /* color: rgb(8, 151, 8); */
    }

    .badge-outline-merah {
      text-align: center;
      background-color: transparent;
      /* border-color: #6c757d; */
      border: 1px solid;
      border-radius: 1rem;
      padding: 0.01em 0.7em;
      color: rgb(222, 17, 17);
    }
  </style>
@endsection

@section('js_bawah')
  {{-- MODAL --}}
  @if (in_array(auth()->user()->role, [
          Level_pengguna::IS_SUPERADMIN,
          Level_pengguna::IS_MANAGER,
          Level_pengguna::IS_ATASAN,
      ]))
    {{-- MODAL KONFIRMASI TERIMA --}}
    <div class="modal fade" id="konfirmasi-terima" data-backdrop="static" tabindex="-1"
      aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog ">
        <div class="modal-content">
          <form enctype="multipart/form-data"
            action="{{ route('perizinan.update', ['perizinan' => $perizinan->izin_id]) }}" method="POST"
            name="perizinan_update">
            @method('PATCH')
            @csrf
            <div class="modal-header">
              <h5 class="modal-title">Konfirmasi</h5>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
              <div>
                <input type="hidden" name="izin_id" id="izin_id" value="{{ $perizinan->izin_id }}">
                <input type="hidden" name="status" id="status" value="diterima">
                {{-- <input type="hidden" name="direksi" id="direksi" value="diterima"> --}}
                <div class="form-group">
                  <p>Pesan untuk {{ $perizinan->pengguna[0]->nama }}</p>
                  <textarea class="form-control" name="pesan" id="pesan" rows="4" required
                    value="{{ old('pesan', $perizinan->pesan) }}" placeholder="Berikan pesan bahwa Anda telah memberikan izin"
                    maxlength="240"></textarea>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button class="btn btn-default" type="button" data-dismiss="modal">Batal</button>
              <button class="btn btn-info" type="submit">Konfirmasi</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    {{-- MODAL KONFIRMASI TOLAK --}}
    <div class="modal fade" id="konfirmasi-tolak" data-backdrop="static" tabindex="-1"
      aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog ">
        <div class="modal-content">
          <form enctype="multipart/form-data"
            action="{{ route('perizinan.update', ['perizinan' => $perizinan->izin_id]) }}" method="POST"
            name="perizinan_update_dua">
            @method('PATCH')
            @csrf
            <div class="modal-header">
              <h5 class="modal-title">Konfirmasi</h5>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
              <div>
                <p>Anda yakin ingin menolak pengajuan izin ini?</p>
                <input type="hidden" name="izin_id" id="izin_id" value="{{ $perizinan->izin_id }}">
                <input type="hidden" name="status" id="status" value="ditolak">
                {{-- <input type="hidden" name="direksi" id="direksi" value="diterima"> --}}
                <div class="form-group">
                  <textarea class="form-control" name="pesan" id="pesan" rows="4"
                    value="{{ old('pesan', $perizinan->pesan) }}" required placeholder="Tuliskan alasan penolakan Anda"
                    maxlength="240"></textarea>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button class="btn btn-default" type="button" data-dismiss="modal">Batal</button>
              <button class="btn btn-secondary" type="submit">Konfirmasi</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    {{-- AKHIR MODAL --}}
  @endif

  {{-- MODAL KONFIRMASI BATALKAN --}}
  @if (in_array(auth()->user()->role, [Level_pengguna::IS_PEGAWAI, Level_pengguna::IS_ATASAN]))
    <div class="modal fade" id="konfirmasi-batal" data-backdrop="static" tabindex="-1"
      aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog ">
        <div class="modal-content">
          <form enctype="multipart/form-data"
            action="{{ route('perizinan.update', ['perizinan' => $perizinan->izin_id]) }}" method="POST"
            name="perizinan_update_tiga">
            @method('PATCH')
            @csrf
            <div class="modal-header">
              <h5 class="modal-title">Konfirmasi</h5>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
              <div>
                <p>Anda yakin ingin membatalkan pengajuan izin ini?</p>
                <input type="hidden" name="izin_id" id="izin_id" value="{{ $perizinan->izin_id }}">
                <input type="hidden" name="status" id="status" value="dibatalkan">
                {{-- <input type="hidden" name="direksi" id="direksi" value="diterima"> --}}
                <div class="form-group">
                  <textarea class="form-control" name="pesan" id="pesan" rows="5" required
                    value="{{ old('pesan', $perizinan->pesan) }}" placeholder="Tuliskan alasan Anda" maxlength="240"></textarea>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button class="btn btn-default" type="button" data-dismiss="modal">Batal</button>
              <button class="btn btn-secondary" type="submit">Konfirmasi</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    {{-- AKHIR MODAL --}}
  @endif

  {{-- NOMER_WA TIDAK TERSEDIA --}}
  <div id="nomer_wa_tdk_ada" class="modal fade" data-backdrop="static" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Pemberitahuan</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          Maaf, kontak WhatsApp atasan Anda belum terdaftar. Silakan hubungi manual melalui aplikasi WhatsApp.
        </div>
        <div class="modal-footer">
          <button class="btn btn-default" type="button" data-dismiss="modal">Baik, Saya Mengerti</button>
        </div>
      </div>
    </div>
  </div>


  {{-- flash hijau --}}
  @if (session()->has('diterima'))
    <script>
      iziToast.success({
        title: 'Berhasil.',
        message: '{{ Session('diterima') }}',
        position: 'topCenter'
      });
    </script>
  @endif

  {{-- flash hijau --}}
  @if (session()->has('ditolak'))
    <script>
      iziToast.error({
        title: 'Ok.',
        message: '{{ Session('ditolak') }}',
        position: 'topCenter'
      });
    </script>
  @endif

  {{-- flash hijau --}}
  @if (session()->has('dibatalkan'))
    <script>
      iziToast.warning({
        title: 'Ok.',
        message: '{{ Session('dibatalkan') }}',
        position: 'topCenter'
      });
    </script>
  @endif

  {{-- flash hijau --}}
  @if (session()->has('galat'))
    <script>
      iziToast.error({
        title: 'Galat.',
        message: '{{ Session('galat') }}',
        position: 'topCenter'
      });
    </script>
  @endif

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

    // validation first form
    // validation first form
    // Wait for the DOM to be ready
    $(function() {
      // Mengambil dan memvalidasi form dengan nama perizinan_update
      $("form[name='perizinan_update'], form[name='perizinan_update_dua'], form[name='perizinan_update_tiga']").each(
        function() {
          $(this).validate({
            // Specify validation rules
            rules: {
              izin_id: {
                required: true,
              },
              pesan: {
                required: true,
                minlength: 3,
              },
            },
            // Specify validation error messages
            messages: {
              izin_id: {
                required: "Nomor formulir harus diisi",
              },
              pesan: {
                required: "Mohon diisi",
                minlength: "Minimal {0} karakter"
              },
            },
            // bagian yang dihighlight
            highlight: function(element) {
              $(element).closest('.form-group > textarea').addClass('is-invalid');

            },
            unhighlight: function(element) {
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
              console.log("valid >> " + form.isValid());
              form.submit();
            }
          });
        });
    });

    function fn_confirm_terima(url) {
      $('#tombol-terima').attr('action', url);
      $('#konfirmasi-terima').modal('show');
    }

    function fn_confirm_tolak(url) {
      $('#tombol-tolak').attr('action', url);
      $('#konfirmasi-tolak').modal('show');
    }

    function fn_confirm_batal(url) {
      $('#tombol-batal').attr('action', url);
      $('#konfirmasi-batal').modal('show');
    }

    function fn_kirim_wa(nomer_wa) {
      $('#tombol-hubungi').attr('action', nomer_wa);
      pesan = alasan_izin.value;
      tanggal = tanggal_izin_awal.value;
      hingga_tanggal = tanggal_izin_akhir.value;
      if (!nomer_wa) {
        $('#nomer_wa_tdk_ada').modal('show');
      } else {
        const urlToWhatsapp =
          `https://api.whatsapp.com/send?phone=${nomer_wa}&text=${encodeURIComponent(`Bapak/Ibu, Saya ingin mengajukan izin pada ${tanggal} dengan alasan ${pesan}\nLink: ${window.location.href}`)}`;
        window.open(urlToWhatsapp, "_blank");
      }
    }
  </script>
@endsection
