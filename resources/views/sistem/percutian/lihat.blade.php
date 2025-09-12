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
      use App\Models\Percutian;
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
            @if ($percutian->status == Percutian::DI_AJUKAN)
              @if (in_array(auth()->user()->role, [Level_pengguna::IS_SUPERADMIN, Level_pengguna::IS_MANAGER]))
                {{-- Untuk superadmin dan manager --}}
                <div class="callout callout-info alert alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <i class="fa fa-info-circle mr-2"></i>Pengajuan cuti menunggu izin dari Atasan Langsung
                  {{ $ketuaunit->user_id ? "($ketuaunit->nama)" : '' }}
                </div>
              @elseif (auth()->user()->role == Level_pengguna::IS_ATASAN)
                {{-- Untuk atasan --}}
                @if ($percutian->pengguna_id == auth()->user()->user_id)
                  {{-- Jika Pengajuan sendiri dan dia atasan juga --}}
                  <div class="callout callout-info alert alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <i class="fa fa-info-circle mr-2"></i>Pengajuan cuti Anda menunggu izin dari Atasan
                    Langsung {{ $ketuaunit->user_id ? "($ketuaunit->nama)" : '' }} <br>
                    <a href="javascript:void(0)" onclick="" class="btn btn-sm btn-info mt-2 "
                      style="text-decoration: none">Hubungi<i class="fa-brands fa-whatsapp fa-lg ml-1"></i>
                    </a>
                  </div>
                @elseif($ketuaunit->user_id == auth()->user()->user_id)
                  {{-- Jika Atasan langsung --}}
                  <div class="callout callout-info alert alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <i class="fa fa-info-circle mr-2"></i>Pengajuan cuti ini menunggu izin Anda.
                  </div>
                @endif
              @elseif (auth()->user()->role == Level_pengguna::IS_PEGAWAI)
                {{-- Untuk pegawai --}}
                {{-- Sama seperti yang atasan, dan dia atasan --}}
                <div class="callout callout-info alert alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <i class="fa fa-info-circle mr-2"></i> Pengajuan cuti Anda menunggu izin dari Atasan
                  Langsung {{ $ketuaunit->user_id ? "($ketuaunit->nama)" : '' }}. <br>
                  <a href="javascript:void(0)" onclick="" class="btn btn-sm btn-info mt-2"
                    style="text-decoration: none">Hubungi<i class="fa-brands fa-whatsapp fa-lg ml-1"></i>
                  </a>
                </div>
              @endif


              {{-- JIKA DIIZINKAN_ATASAN --}}
              {{-- JIKA DIIZINKAN_ATASAN --}}
            @elseif ($percutian->status == Percutian::DI_IZINKAN_ATASAN)
              @if (in_array(auth()->user()->role, [Level_pengguna::IS_SUPERADMIN, Level_pengguna::IS_MANAGER]))
                @if (auth()->user()->user_id == 2141)
                  {{-- ANDA WAKA II, LAKUKAN PENYETUJUAN --}}
                  <div class="callout callout-info alert alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <i class="fa fa-info-circle mr-2"></i> Pengajuan cuti ini menunggu persetujuan Anda.
                  </div>
                @else
                  {{-- Override Superadmin dan Manager --}}
                  {{-- ANDA SUPERADMIN DAN MANAGER / SAMA SEPERTI WAKA II DO --}}
                  <div class="callout callout-info alert alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <i class="fa fa-info-circle mr-2"></i>Pengajuan cuti menunggu persetujuan dari Pimpinan
                    Berwenang {{ $pimpinan->user_id ? "($pimpinan->nama)" : '' }}
                  </div>
                @endif
              @elseif ($percutian->izin_dari == auth()->user()->user_id)
                {{-- Jika atasan yang bersangkutan --}}
                <div class="callout callout-info alert alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <i class="fa fa-info-circle mr-2"></i>Pengajuan cuti telah Anda izinkan. Sekarang menunggu persetujuan
                  dari Pimpinan Berwenang {{ $pimpinan->user_id ? "($pimpinan->nama)" : '' }}
                </div>
              @elseif ($percutian->pengguna_id == auth()->user()->user_id)
                {{-- Jika pengaju --}}
                <div class="callout callout-info alert alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <i class="fa fa-info-circle mr-2"></i> Pengajuan cuti Anda menunggu persetujuan dari Pimpinan
                  Berwenang {{ $pimpinan->user_id ? "($pimpinan->nama)" : '' }}
                  <br>
                  <a href="javascript:void(0)" onclick="" class="btn btn-sm btn-default mt-2 "
                    style="color:dimgray; text-decoration: none">Atur Pertemuan
                    <i class="fa-brands fa-whatsapp fa-lg ml-1"></i>
                  </a>
                </div>
              @endif

              {{-- JIKA DISETUJUI PIMPINAN --}}
              {{-- JIKA DISETUJUI PIMPINAN --}}
            @elseif ($percutian->status == Percutian::DI_SETUJUI_PIMPINAN)
              @if (in_array(auth()->user()->role, [Level_pengguna::IS_SUPERADMIN, Level_pengguna::IS_MANAGER]))
                @if (auth()->user()->user_id == 2141)
                  {{-- ANDA ADALAH WAKA II --}}
                  <div class="callout callout-success alert alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <i class="fas fa-circle-check mr-2"></i>Pengajuan cuti telah Anda setujui.
                  </div>
                @else
                  {{-- ANDA ADALAH SUPERADMIN dan MANAGER --}}
                  <div class="callout callout-success alert alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <i class="fas fa-circle-check mr-2"></i>Pengajuan cuti ini telah disetujui Pimpinan.
                  </div>
                @endif
              @elseif ($percutian->izin_dari == auth()->user()->user_id)
                {{-- Jika atasan yang bersangkutan --}}
                <div class="callout callout-success alert alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <i class="fas fa-circle-check mr-2"></i>Pengajuan cuti ini telah disetujui Pimpinan.
                </div>
              @elseif ($percutian->pengguna_id == auth()->user()->user_id)
                {{-- Jika pengaju --}}
                <div class="callout callout-success alert alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <i class="fas fa-circle-check fa-bounce mr-2"></i><b>Selamat! </b>
                  Pengajuan cuti Anda telah disetujui Pimpinan.
                </div>
              @else
                {{-- Harus kosong --}}
              @endif

              {{-- JIKA DITOLAK --}}
              {{-- JIKA DITOLAK --}}
            @elseif ($percutian->status == Percutian::DI_TOLAK)
              {{-- Semua jenis user yang melihat --}}
              <div class="callout callout-danger alert alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <i class="fas fa-triangle-exclamation mr-2"></i>Pengajuan cuti ditolak oleh
                {{ $percutian->tolak_oleh[0]->user_id == auth()->user()->user_id ? 'Anda' : $percutian->tolak_oleh[0]->nama }}
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
                      @switch($percutian->status)
                        @case(Percutian::DI_SETUJUI_PIMPINAN)
                          <p class="badge badge-success mb-0" style=" font-size: 100%;font-weight:400;">
                            <i class="ion ion-android-done-all mx-1"></i>
                            Disetujui Pimpinan
                          </p>
                        @break

                        @case(Percutian::DI_IZINKAN_ATASAN)
                          <p class="badge badge-secondary mb-0" style=" font-size: 100%;font-weight:400;">
                            <i class="ion ion-android-done mx-1"></i>
                            Diizinkan Atasan
                          </p>
                        @break

                        @case(Percutian::DI_AJUKAN)
                          <p class="badge badge-secondary mb-0" style=" font-size: 100%;font-weight:400;">
                            <i class="ion ion-android-radio-button-on mx-1"></i>
                            Pengajuan
                          </p>
                        @break

                        @case(Percutian::DI_TOLAK)
                          <p class="badge badge-danger mb-0" style=" font-size: 100%;font-weight:400;">
                            <i class="ion ion-android-close mx-1"></i>
                            Ditolak
                          </p>
                        @break

                        @case(Percutian::DI_BATALKAN)
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
                    <td>: {!! $percutian->pengguna[0]->nama !!}</td>
                  </tr>
                  <tr>
                    <td style="width: 35%"><b>NPPY</b></td>
                    <td>: {!! $percutian->pengguna[0]->nomer_induk ?? $kosong !!}</td>
                  </tr>
                  <tr>
                    <td style="width: 35%"><b>Pengajuan</b></td>
                    <td>: {!! Carbon\Carbon::parse($percutian->tanggal_ajuan)->isoFormat('dddd, D MMMM Y [pukul] HH:mm') ?? $kosong !!}
                    </td>
                  </tr>
                </table>
                <hr>
                <table class="table table-sm table-borderless">
                  <tr>
                    <td style="width: 35%;"><b>Kategori Cuti</b></td>
                    <td>:
                      {!! $percutian->kateg_cuti[0]->jenis_cuti ?? $kosong !!}
                    </td>
                  </tr>
                  <tr>
                    <td style="width: 35%;"><b>Tanggal</b></td>
                    <td>: {!! Carbon\Carbon::parse($percutian->tanggal_cuti_awal)->isoFormat('dddd, D MMMM Y') ?? $kosong !!}
                  </tr>
                  <tr>
                    <td style="width: 35%;"><b>Sampai</b></td>
                    <td>: {!! Carbon\Carbon::parse($percutian->tanggal_cuti_akhir)->isoFormat('dddd, D MMMM Y') ?? $kosong !!}</td>
                  </tr>
                  <tr>
                    <td style="width: 35%;"><b>Lama Cuti</b></td>
                    <td>: {!! $percutian->berapa_lama ?? $kosong !!}</td>
                  </tr>
                  <tr>
                    <td style="width: 35%;"><b>Keperluan</b></td>
                    <td>: {!! $percutian->keperluan_cuti ?? $kosong !!}</td>
                  </tr>
                  @if ($percutian->bukti != null)
                    <tr>
                      <td style="width: 35%;"><b>Lampiran</b></td>
                      <td>:
                        <span class="text-primary">
                          <a href="/storage/{!! $percutian->bukti !!}" target="_blank">Lihat gambar/berkas</a>
                      </td>
                      </p>
                    </tr>
                  @endif
                </table>

                @if ($percutian->status == Percutian::DI_BATALKAN)
                  <hr>
                  <table class="table table-sm table-borderless">
                    <tr>
                      <td style="width: 35%;"><b>Alasan Batal</b></td>
                      <td>: {!! $percutian->pesan ?? $kosong !!}</td>
                    </tr>
                  </table>
                @endif


                <input type="hidden" id="keperluan_cuti" value="{{ $percutian->keperluan_cuti ?? $kosong }}">
                <input type="hidden" id="tanggal_cuti_awal"
                  value="{{ Carbon\Carbon::parse($percutian->tanggal_cuti_awal)->isoFormat('dddd, D MMMM Y') ?? $kosong }}">
                <input type="hidden" id="tanggal_cuti_akhir"
                  value="{{ Carbon\Carbon::parse($percutian->tanggal_cuti_akhir)->isoFormat('dddd, D MMMM Y') ?? $kosong }}">
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
                  @if ($ketuaunit->user_id == $percutian->tolak_dari)
                    <span class="text-center badge-outline-merah">
                      Menolak</span>
                  @endif
                  <p class="text-muted">{{ $ketuaunit->nama }}
                    <br>{{ 'NPPY. ' . $ketuaunit->nomer_induk }}
                  </p>
                </span>

                {{-- UNTUK TERIZIN DARI ATASAN --}}
                @if (
                    $percutian->pesan != null && //jika percutian ada pesannya &
                        in_array($percutian->status, [
                            //jika memiliki status berikut
                            Percutian::DI_IZINKAN_ATASAN,
                            Percutian::DI_SETUJUI_PIMPINAN,
                            Percutian::DI_TOLAK,
                        ]))
                  <hr>
                  <div class="row">
                    <div class="col-md-6">
                      <strong>Pesan</strong>
                      <p class="text-muted">{{ $percutian->pesan }}</p>
                    </div>
                    <div class="col-md-6">
                      <strong>TTD</strong>
                      @if ($percutian->izin_dari == $ketuaunit->user_id)
                        <span class="text-nowrap" style="color: rgb(14, 164, 14)">valid
                          <i class="ion ion-checkmark"></i>
                        </span>
                        <p class="text-muted">Disahkan pada
                          {{ \Carbon\Carbon::parse($percutian->tgl_izin)->translatedFormat('d F Y') }} pukul
                          {{ \Carbon\Carbon::parse($percutian->tgl_izin)->translatedFormat('H:i') }}
                        </p>
                      @else
                        <span class="text-nowrap" style="color: rgba(0, 0, 0, 0.5)">diwakilkan
                          <i class="ion ion-checkmark"></i>
                        </span>
                        <p class="text-muted">Oleh {{ $percutian->izin_oleh[0]->nama }} pada
                          {{ \Carbon\Carbon::parse($percutian->tgl_izin)->translatedFormat('d F Y') }} pukul
                          {{ \Carbon\Carbon::parse($percutian->tgl_izin)->translatedFormat('H:i') }}
                        </p>
                      @endif
                    </div>
                  </div>
                @endif

                {{-- UNTUK PENOLAKAN OLEH ATASAN --}}
                @if (
                    $percutian->tolak_pesan != null && //jika ada pesan penolakan &
                        in_array($percutian->status, [
                            //jika memiliki status berikut
                            Percutian::DI_TOLAK,
                        ]))
                  @if ($percutian->tolak_dari == $ketuaunit->user_id)
                    {{-- tampilkan hanya jika atasan yang menolak --}}
                    <hr>
                    <div class="row">
                      <div class="col-md-6">
                        <strong>Alasan</strong>
                        <p class="text-muted">{{ $percutian->tolak_pesan }}</p>
                      </div>
                      <div class="col-md-6">
                        <strong>TTD</strong>
                        @if ($percutian->tolak_dari == $ketuaunit->user_id)
                          <span class="text-nowrap" style="color: rgb(14, 164, 14)">valid
                            <i class="ion ion-checkmark"></i>
                          </span>
                          <p class="text-muted">Pada tanggal
                            {{ \Carbon\Carbon::parse($percutian->tgl_tolak)->translatedFormat('d F Y') }} pukul
                            {{ \Carbon\Carbon::parse($percutian->tgl_tolak)->translatedFormat('H:i') }}
                          </p>
                        @else
                          <span class="text-nowrap" style="color: rgba(0, 0, 0, 0.5)">diwakilkan
                            <i class="ion ion-checkmark"></i>
                          </span>
                          <p class="text-muted">Oleh {{ $percutian->tolak_oleh[0]->nama }} pada
                            {{ \Carbon\Carbon::parse($percutian->tgl_tolak)->translatedFormat('d F Y') }} pukul
                            {{ \Carbon\Carbon::parse($percutian->tgl_tolak)->translatedFormat('H:i') }}
                          </p>
                        @endif
                      </div>
                    </div>
                  @endif
                @endif
              </div>
            </div>

            {{-- Pimpinan --}}
            {{-- Pimpinan --}}
            {{-- Pimpinan --}}
            <div class="card card-default">
              <div class="card-body" style="padding-bottom: 0em">
                <strong class="mr-0"><i class="fas fa-user-tie mr-2"></i>Pimpinan Berwenang</strong>
                <span class="mr-1">
                  (Waka II)
                </span>
                <span class="text-nowrap">
                  @if ($pimpinan->user_id == auth()->user()->user_id)
                    <span class="text-center badge-outline-aktif mr-1">
                      Anda
                    </span>
                  @endif
                  @if ($pimpinan->user_id == $percutian->tolak_dari)
                    <span class="text-center badge-outline-merah">
                      Menolak</span>
                  @endif
                </span>
                <p class="text-muted">{{ $pimpinan->nama }}
                  <br>{{ 'NPPY. ' . $pimpinan->nomer_induk }}
                </p>
                {{-- UNTUK TERSETUJUI DARI PIMPINAN --}}
                @if (
                    $percutian->setuju_pesan != null && //jika percutian ada pesannya &
                        in_array($percutian->status, [
                            //jika memiliki status berikut
                            Percutian::DI_IZINKAN_ATASAN,
                            Percutian::DI_SETUJUI_PIMPINAN,
                            // Percutian::DI_TOLAK,
                        ]))
                  <hr>
                  <div class="row">
                    <div class="col-md-6">
                      <strong>Pesan</strong>
                      <p class="text-muted">{{ $percutian->setuju_pesan }}</p>
                    </div>
                    <div class="col-md-6">
                      <strong>TTD</strong>
                      @if ($percutian->setuju_dari == $pimpinan->user_id)
                        <span class="text-nowrap" style="color: rgb(14, 164, 14)">valid
                          <i class="ion ion-checkmark"></i>
                        </span>
                        <p class="text-muted">Disahkan pada
                          {{ \Carbon\Carbon::parse($percutian->tgl_setuju)->translatedFormat('d F Y') }} pukul
                          {{ \Carbon\Carbon::parse($percutian->tgl_setuju)->translatedFormat('H:i') }}
                        </p>
                      @else
                        <span class="text-nowrap" style="color: rgba(0, 0, 0, 0.5)">diwakilkan
                          <i class="ion ion-checkmark"></i>
                        </span>
                        <p class="text-muted">Oleh {{ $percutian->setuju_oleh[0]->nama }} pada
                          {{ \Carbon\Carbon::parse($percutian->tgl_setuju)->translatedFormat('d F Y') }} pukul
                          {{ \Carbon\Carbon::parse($percutian->tgl_setuju)->translatedFormat('H:i') }}
                        </p>
                      @endif
                    </div>
                  </div>
                @endif


                {{-- UNTUK PENOLAKAN OLEH PIMPINAN --}}
                @if (
                    $percutian->tolak_pesan != null && //jika ada pesan penolakan &
                        in_array($percutian->status, [
                            //jika memiliki status berikut
                            Percutian::DI_TOLAK,
                        ]))
                  @if ($percutian->tolak_dari == $pimpinan->user_id)
                    {{-- tampilkan hanya jika pimpinan yang menolak --}}
                    <hr>
                    <div class="row">
                      <div class="col-md-6">
                        <strong>Alasan</strong>
                        <p class="text-muted">{{ $percutian->tolak_pesan }}</p>
                      </div>
                      <div class="col-md-6">
                        <strong>TTD</strong>
                        @if ($percutian->tolak_dari == $pimpinan->user_id)
                          <span class="text-nowrap" style="color: rgb(14, 164, 14)">valid
                            <i class="ion ion-checkmark"></i>
                          </span>
                          <p class="text-muted">Pada tanggal
                            {{ \Carbon\Carbon::parse($percutian->tgl_tolak)->translatedFormat('d F Y') }} pukul
                            {{ \Carbon\Carbon::parse($percutian->tgl_tolak)->translatedFormat('H:i') }}
                          </p>
                        @else
                          <span class="text-nowrap" style="color: rgba(0, 0, 0, 0.5)">diwakilkan
                            <i class="ion ion-checkmark"></i>
                          </span>
                          <p class="text-muted">Oleh {{ $percutian->tolak_oleh[0]->nama }} pada
                            {{ \Carbon\Carbon::parse($percutian->tgl_tolak)->translatedFormat('d F Y') }} pukul
                            {{ \Carbon\Carbon::parse($percutian->tgl_tolak)->translatedFormat('H:i') }}
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
                $percutian->status == Percutian::DI_TOLAK &&
                    in_array(auth()->user()->role, [Level_pengguna::IS_SUPERADMIN, Level_pengguna::IS_MANAGER]))
              @if ($percutian->tolak_dari != $ketuaunit->user_id)
                <div class="card card-default">
                  <div class="card-body" style="padding-bottom: 0em">
                    <strong class="mb-0 text-danger"><i class="fas fa-triangle-exclamation mr-2"></i>
                      {{ $percutian->tolak_oleh[0]->nama }} Melakukan Penolakan</strong>
                    <div class="row">
                      <div class="col-md-12">
                        <p class="text-muted">Alasan: {{ $percutian->tolak_pesan }}
                          @if ($percutian->tgl_tolak != null)
                            <br>
                            Pada: {{ \Carbon\Carbon::parse($percutian->tgl_tolak)->translatedFormat('d F Y') }} pukul
                            {{ \Carbon\Carbon::parse($percutian->tgl_tolak)->translatedFormat('H:i') }}
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
                        case route('percutian.index'):
                            $targetRoute = route('percutian.index');
                            break;
                        case route('percutian.disetujui_pimpinan'):
                            $targetRoute = route('percutian.disetujui_pimpinan');
                            break;
                        case route('percutian.diizinkan_atasan'):
                            $targetRoute = route('percutian.diizinkan_atasan');
                            break;
                        case route('percutian.dibatalkan'):
                            $targetRoute = route('percutian.dibatalkan');
                            break;
                        case route('percutian.diajukan'):
                            $targetRoute = route('percutian.diajukan');
                            break;
                        case route('percutian.ditolak'):
                            $targetRoute = route('percutian.ditolak');
                            break;
                        // Memeriksa URL dengan parameter ID
                        case Str::is(route('presensi.lihat', ['id' => '*']), $previousUrl):
                            // Mengambil ID dari URL sebelumnya
                            $id = last(explode('/', $previousUrl));
                            $targetRoute = route('presensi.lihat', ['id' => $id]);
                            break;
                        // Kalau sama dengan link sebelumnya
                        case $previousUrl === url()->current():
                            $targetRoute = route('percutian.index');
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

                  @if ($percutian->status == Percutian::DI_AJUKAN)
                    {{-- JIKA DIAJUKAN --}}
                    @if (in_array(auth()->user()->role, [Level_pengguna::IS_SUPERADMIN, Level_pengguna::IS_MANAGER]))
                      {{-- Untuk superadmin dan manager --}}
                      <a href="javascript:void(0)" onclick="fn_confirm_izinkan('/')" id="tombol-terima"
                        class="btn btn-success float-right ml-2">Izinkan
                        <i class="ion ion-android-done ml-1"></i></a>
                      <a href="javascript:void(0)" onclick="fn_confirm_tolak('/')" id="tombol-tolak"
                        class="btn btn-secondary float-right">Tolak
                        <i class="ion ion-android-close ml-1"></i></a>
                    @elseif (auth()->user()->role == Level_pengguna::IS_ATASAN)
                      {{-- Untuk atasan --}}
                      @if (auth()->user()->role == Level_pengguna::IS_ATASAN && $percutian->pengguna_id == auth()->user()->user_id)
                        {{-- Jika Pengajuan sndiri dan dia atasan juga --}}
                        {{-- <span class="float-right my-2"> MENUNGGU APPROVAL ATASAN LANGSUNG</span> --}}
                        <a href="javascript:void(0)" onclick="fn_confirm_batal('/')" id="tombol-batal"
                          class="btn btn-secondary float-right">Batalkan
                          <i class="ion ion-android-remove-circle ml-1"></i></a>
                      @elseif(auth()->user()->role == Level_pengguna::IS_ATASAN && $ketuaunit->user_id == auth()->user()->user_id)
                        {{-- Jika Atasan langsung --}}
                        <a href="javascript:void(0)" onclick="fn_confirm_izinkan('/')" id="tombol-terima"
                          class="btn btn-success float-right ml-2">Izinkan<i class="ion ion-android-done ml-1"></i></a>
                        <a href="javascript:void(0)" onclick="fn_confirm_tolak('/')" id="tombol-tolak"
                          class="btn btn-secondary float-right">Tolak<i class="ion ion-android-close ml-1"></i></a>
                      @endif
                    @elseif (auth()->user()->role == Level_pengguna::IS_PEGAWAI)
                      {{-- Untuk pegawai --}}
                      <a href="javascript:void(0)" onclick="fn_confirm_batal('/')" id="tombol-batal"
                        class="btn btn-secondary float-right">Batalkan
                        <i class="ion ion-android-remove-circle ml-1"></i>
                      </a>
                    @endif
                  @elseif ($percutian->status == Percutian::DI_IZINKAN_ATASAN)
                    {{-- JIKA DIIZINKAN_ATASAN --}}
                    @if (in_array(auth()->user()->role, [Level_pengguna::IS_SUPERADMIN, Level_pengguna::IS_MANAGER]) &&
                            auth()->user()->user_id == 2141)
                      {{-- ANDA WAKA II, LAKUKAN PENYETUJUAN --}}
                      <a href="javascript:void(0)" onclick="fn_confirm_terima_pimpinan('/')" id="tombol-terima"
                        class="btn btn-success float-right ml-2">Setujui<i
                          class="ion ion-android-done-all ml-1"></i></a>
                      <a href="javascript:void(0)" onclick="fn_confirm_tolak_pimpinan('/')" id="tombol-tolak"
                        class="btn btn-secondary float-right">Tolak<i class="ion ion-android-close ml-1"></i></a>
                    @elseif ($percutian->status == Percutian::DI_IZINKAN_ATASAN && $percutian->pengguna_id == auth()->user()->user_id)
                      {{-- Jika pengaju --}}
                    @elseif (in_array(auth()->user()->role, [Level_pengguna::IS_SUPERADMIN, Level_pengguna::IS_MANAGER]) &&
                            $percutian->status == Percutian::DI_IZINKAN_ATASAN)
                      {{-- Override Superadmin dan Manager --}}
                      {{-- ANDA SUPERADMIN DAN MANAGER / SAMA SEPERTI WAKA II DO --}}
                      <a href="javascript:void(0)" onclick="fn_confirm_terima_pimpinan('/')" id="tombol-terima"
                        class="btn btn-success float-right ml-2">Setujui<i
                          class="ion ion-android-done-all ml-1"></i></a>
                      <a href="javascript:void(0)" onclick="fn_confirm_tolak_pimpinan('/')" id="tombol-tolak"
                        class="btn btn-secondary float-right">Tolak<i class="ion ion-android-close ml-1"></i></a>
                    @endif

                    {{-- JIKA DISETUJUI PIMPINAN --}}
                    {{-- JIKA DISETUJUI PIMPINAN --}}
                  @elseif ($percutian->status == Percutian::DI_SETUJUI_PIMPINAN)
                    @if (in_array(auth()->user()->role, [Level_pengguna::IS_SUPERADMIN, Level_pengguna::IS_MANAGER]))
                      <a onclick="window.print()" class="btn btn-primary float-right ml-2">Cetak
                        <i class="fas fa-print ml-1"></i>
                      </a>
                    @elseif ($percutian->izin_dari == auth()->user()->user_id)
                      {{-- Jika atasan yang bersangkutan --}}
                      {{-- kosong --}}
                    @elseif ($percutian->pengguna_id == auth()->user()->user_id)
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
  {{-- bagian js bawah --}}
  @if (in_array(auth()->user()->role, [
          Level_pengguna::IS_SUPERADMIN,
          Level_pengguna::IS_MANAGER,
          Level_pengguna::IS_ATASAN,
      ]))
    {{-- MODAL KONFIRMASI TERIMA (PIMPINAN) --}}
    <div class="modal fade" id="konfirmasi-terima" data-backdrop="static" tabindex="-1"
      aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog ">
        <div class="modal-content">
          <form enctype="multipart/form-data"
            action="{{ route('percutian.update', ['percutian' => $percutian->cuti_id]) }}" method="POST"
            name="form_percutian_terima">
            @method('PATCH')
            @csrf
            <div class="modal-header">
              <h5 class="modal-title">Konfirmasi Pimpinan</h5>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
              <div>
                <input type="hidden" name="cuti_id" id="cuti_id" value="{{ $percutian->cuti_id }}">
                <input type="hidden" name="status" id="status" value="disetujui_pimpinan">
                <div class="form-group">
                  <p>Anda akan menerima pengajuan dari {{ $percutian->pengguna[0]->nama }}</p>
                  <textarea class="form-control" name="pesan_terima" id="pesan_terima" rows="4" required
                    value="{{ old('pesan', $percutian->pesan) }}" placeholder="Berikan pesan untuknya" maxlength="240"></textarea>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button class="btn btn-default" type="button" data-dismiss="modal">Batal</button>
              <button class="btn btn-success" type="submit">Konfirmasi</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    {{-- MODAL KONFIRMASI IZINKAN (ATASAN) --}}
    <div class="modal fade" id="konfirmasi-izinkan" data-backdrop="static" tabindex="-1"
      aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog ">
        <div class="modal-content">
          <form enctype="multipart/form-data"
            action="{{ route('percutian.update', ['percutian' => $percutian->cuti_id]) }}" method="POST"
            name="form_percutian_izinkan">
            @method('PATCH')
            @csrf
            <div class="modal-header">
              <h5 class="modal-title">Konfirmasi Atasan</h5>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
              <div>
                <input type="hidden" name="cuti_id" id="cuti_id" value="{{ $percutian->cuti_id }}">
                <input type="hidden" name="status" id="status" value="diizinkan_atasan">
                <div class="form-group">
                  <p>Anda akan mengizinkan pengajuan dari {{ $percutian->pengguna[0]->nama }}</p>
                  <textarea class="form-control" name="pesan" id="pesan" rows="4" required
                    value="{{ old('pesan', $percutian->pesan) }}" placeholder="Berikan pesan untuknya" maxlength="240"></textarea>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button class="btn btn-default" type="button" data-dismiss="modal">Batal</button>
              <button class="btn btn-success" type="submit">Konfirmasi</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    {{-- MODAL KONFIRMASI TOLAK --}}
    {{-- hampir fix --}}
    <div class="modal fade" id="konfirmasi-tolak" data-backdrop="static" tabindex="-1"
      aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog ">
        <div class="modal-content">
          <form enctype="multipart/form-data"
            action="{{ route('percutian.update', ['percutian' => $percutian->cuti_id]) }}" method="POST"
            name="form_percutian_tolak">
            @method('PATCH')
            @csrf
            <div class="modal-header">
              <h5 class="modal-title">Konfirmasi Tolak</h5>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
              <div>
                <p>Anda yakin ingin menolak pengajuan cuti ini?</p>
                <input type="hidden" name="cuti_id" id="cuti_id" value="{{ $percutian->cuti_id }}">
                <input type="hidden" name="status" id="status" value="ditolak">
                <div class="form-group">
                  <textarea class="form-control" name="pesan_tolak" id="pesan_tolak" rows="5"
                    value="{{ old('pesan_tolak', $percutian->pesan) }}" required placeholder="Alasan penolakan Anda" maxlength="240"></textarea>
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
  @endif

  {{-- MODAL KONFIRMASI BATALKAN --}}
  @if (in_array(auth()->user()->role, [Level_pengguna::IS_PEGAWAI, Level_pengguna::IS_ATASAN]))
    {{-- fixed --}}
    <div class="modal fade" id="konfirmasi-batal" data-backdrop="static" tabindex="-1"
      aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog ">
        <div class="modal-content">
          <form enctype="multipart/form-data"
            action="{{ route('percutian.update', ['percutian' => $percutian->cuti_id]) }}" method="POST"
            name="form_percutian_batal">
            @method('PATCH')
            @csrf
            <div class="modal-header">
              <h5 class="modal-title">Konfirmasi</h5>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
              <div>
                <p>Anda yakin ingin membatalkan pengajuan cuti ini?</p>
                <input type="hidden" name="cuti_id" id="cuti_id" value="{{ $percutian->cuti_id }}">
                <input type="hidden" name="status" id="status" value="dibatalkan">
                <div class="form-group">
                  <textarea class="form-control" name="pesan" id="pesan" rows="5" required
                    value="{{ old('pesan', $percutian->pesan) }}" placeholder="Alasan pembatalan Anda" maxlength="240"></textarea>
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
  @if (session()->has('disetujui_pimpinan'))
    <script>
      iziToast.success({
        title: 'Berhasil.',
        message: '{{ Session('disetujui_pimpinan') }}',
        position: 'topCenter'
      });
    </script>
  @endif

  {{-- flash hijau --}}
  @if (session()->has('diizinkan_atasan'))
    <script>
      iziToast.success({
        title: 'Berhasil.',
        message: '{{ Session('diizinkan_atasan') }}',
        position: 'topCenter'
      });
    </script>
  @endif

  {{-- flash hijau --}}
  @if (session()->has('ditolak'))
    <script>
      iziToast.error({
        title: 'Berhasil.',
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

    // Fungsi untuk menghasilkan aturan validasi
    function generateValidationRules(fields) {
      var rules = {};
      fields.forEach(function(field) {
        rules[field] = {
          required: true,
          minlength: 3,
        };
      });
      return rules;
    }

    // Fungsi untuk menghasilkan pesan validasi
    function generateValidationMessages(fields) {
      var messages = {};
      fields.forEach(function(field) {
        messages[field] = {
          required: "Mohon diisi",
          minlength: "Minimal {0} karakter",
        };
      });
      return messages;
    }

    // Daftar field yang akan divalidasi
    var fields = [
      "status",
      "pesan",
      "pesan_tolak",
      "pesan_terima",
    ];

    // Fungsi validasi di sini
    // Fungsi validasi di sini
    // Mengambil validasi dengan banyak form sekaligus
    $(function() {
      $("form[name='form_percutian_terima'], form[name='form_percutian_izinkan'], form[name='form_percutian_tolak'], form[name='form_percutian_batal']")
        .each(
          function() {
            $(this).validate({
              //menspesifikasikan rules validasi
              rules: generateValidationRules(fields),
              //menspesifikasikan pesan
              messages: generateValidationMessages(fields),
              //bagian yang dihighlight
              highlight: function(element) {
                $(element).closest('.form-group > textarea').addClass('is-invalid');
              },
              //bagian yang dibersikan highlight
              unhighlight: function(element) {
                $(element).closest('.form-group > textarea').removeClass('is-invalid');
              },
              //membuat elemen eror
              errorElement: 'div',
              errorClass: 'invalid-feedback',
              errorPlacement: function(error, element) {
                if (element.parent('.input-group').length) {
                  error.insertAfter(element.parent());
                } else {
                  error.insertAfter(element);
                }
              },
              //handler untuk submit
              submitHandler: function(form) {
                console.log("valid >> " + form.isValid());
                form.submit();
              }
            });
          }
        );
    });

    function fn_confirm_terima_pimpinan(url) {
      // $('#tombol-terima').attr('action', url);
      $('#konfirmasi-terima').modal('show');
    }

    function fn_confirm_tolak_pimpinan(url) {
      // $('#tombol-tolak').attr('action', url);
      $('#konfirmasi-tolak').modal('show');
    }
    /////////////////////////////////////////
    /////////////////////////////////////////

    function fn_confirm_izinkan(url) {
      // $('#tombol-terima').attr('action', url);
      $('#konfirmasi-izinkan').modal('show');
    }
    /////////////////////////////////////////
    /////////////////////////////////////////

    function fn_confirm_tolak(url) {
      // $('#tombol-tolak').attr('action', url);
      $('#konfirmasi-tolak').modal('show');
    }
    /////////////////////////////////////////

    function fn_confirm_batal(url) {
      // $('#tombol-batal').attr('action', url);
      $('#konfirmasi-batal').modal('show');
    }

    function fn_kirim_wa(nomer_wa) {
      $('#tombol-hubungi').attr('action', nomer_wa);
      pesan = keperluan_cuti.value;
      tanggal = tanggal_cuti_awal.value;
      hingga_tanggal = tanggal_cuti_akhir.value;
      if (!nomer_wa) {
        $('#nomer_wa_tdk_ada').modal('show');
      } else {
        const urlToWhatsapp =
          `https://api.whatsapp.com/send?phone=${nomer_wa}&text=${encodeURIComponent(`Bapak/Ibu, Saya ingin mengajukan cuti pada ${tanggal} dengan alasan ${pesan}\nLink: ${window.location.href}`)}`;
        window.open(urlToWhatsapp, "_blank");
      }
    }
  </script>
@endsection
