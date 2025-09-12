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
      use App\Models\Perdinasan;
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
            @if ($perdinasan->status == Perdinasan::DI_AJUKAN)
              @if (in_array(auth()->user()->role, [Level_pengguna::IS_SUPERADMIN, Level_pengguna::IS_MANAGER]))
                {{-- Untuk superadmin dan manager --}}
                <div class="callout callout-info alert alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <i class="fa fa-info-circle mr-2"></i>Pengajuan dinas menunggu persetujuan dari Pimpinan Berwenang.
                </div>
              @elseif (auth()->user()->role == Level_pengguna::IS_ATASAN)
                {{-- Untuk atasan --}}
                @if ($perdinasan->pengguna_id == auth()->user()->user_id)
                  {{-- Jika Pengajuan sendiri dan dia atasan juga --}}
                  <div class="callout callout-info alert alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <i class="fa fa-info-circle mr-2"></i>Pengajuan dinas Anda menunggu persetujuan dari Pimpinan
                    Berwenang.
                    <a href="javascript:void(0)" onclick="" class="btn btn-sm btn-info mt-2 "
                      style="text-decoration: none">Hubungi<i class="fa-brands fa-whatsapp fa-lg ml-1"></i>
                    </a>
                  </div>
                @endif
              @elseif (auth()->user()->role == Level_pengguna::IS_PEGAWAI)
                {{-- Untuk pegawai --}}
                {{-- Sama seperti yang atasan, dan dia atasan --}}
                <div class="callout callout-info alert alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <i class="fa fa-info-circle mr-2"></i> Pengajuan dinas Anda menunggu persetujuan dari Pimpinan
                  Berwenang.
                  <br>
                  <a href="javascript:void(0)" onclick="" class="btn btn-sm btn-info mt-2"
                    style="text-decoration: none">Hubungi<i class="fa-brands fa-whatsapp fa-lg ml-1"></i>
                  </a>
                </div>
              @endif


              {{-- JIKA DISETUJUI PIMPINAN --}}
              {{-- JIKA DISETUJUI PIMPINAN --}}
            @elseif ($perdinasan->status == Perdinasan::DI_SETUJUI_PIMPINAN)
              @if (in_array(auth()->user()->role, [Level_pengguna::IS_SUPERADMIN, Level_pengguna::IS_MANAGER]))
                @if (auth()->user()->user_id == 2141)
                  {{-- ANDA ADALAH WAKA II --}}
                  <div class="callout callout-success alert alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <i class="fas fa-circle-check mr-2"></i>Pengajuan telah Anda setujui.
                  </div>
                @else
                  {{-- ANDA ADALAH SUPERADMIN dan MANAGER --}}
                  <div class="callout callout-success alert alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <i class="fas fa-circle-check mr-2"></i>Pengajuan ini telah disetujui Pimpinan.
                  </div>
                @endif
              @elseif ($perdinasan->izin_dari == auth()->user()->user_id)
                {{-- Jika atasan yang bersangkutan --}}
                <div class="callout callout-success alert alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <i class="fas fa-circle-check mr-2"></i>Pengajuan ini telah disetujui Pimpinan.
                </div>
              @elseif ($perdinasan->pengguna_id == auth()->user()->user_id)
                {{-- Jika pengaju --}}
                <div class="callout callout-success alert alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <i class="fas fa-circle-check fa-bounce mr-2"></i><b>Selamat! </b>
                  Pengajuan Anda telah disetujui Pimpinan.
                </div>
              @else
                {{-- Harus kosong --}}
              @endif

              {{-- JIKA DITOLAK --}}
              {{-- JIKA DITOLAK --}}
            @elseif ($perdinasan->status == Perdinasan::DI_TOLAK)
              {{-- Semua jenis user yang melihat --}}
              <div class="callout callout-danger alert alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <i class="fas fa-triangle-exclamation mr-2"></i>Pengajuan telah ditolak
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
                      @switch($perdinasan->status)
                        @case(Perdinasan::DI_SETUJUI_PIMPINAN)
                          <p class="badge badge-success mb-0" style=" font-size: 100%;font-weight:400;">
                            <i class="ion ion-android-done-all mx-1"></i>
                            Disetujui Pimpinan
                          </p>
                        @break

                        @case(Perdinasan::DI_AJUKAN)
                          <p class="badge badge-secondary mb-0" style=" font-size: 100%;font-weight:400;">
                            <i class="ion ion-android-radio-button-on mx-1"></i>
                            Pengajuan
                          </p>
                        @break

                        @case(Perdinasan::DI_TOLAK)
                          <p class="badge badge-danger mb-0" style=" font-size: 100%;font-weight:400;">
                            <i class="ion ion-android-close mx-1"></i>
                            Ditolak
                          </p>
                        @break

                        @case(Perdinasan::DI_BATALKAN)
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
                    <td>: {!! $perdinasan->pengguna[0]->nama !!}</td>
                  </tr>
                  <tr>
                    <td style="width: 35%"><b>NPPY</b></td>
                    <td>: {!! $perdinasan->pengguna[0]->nomer_induk ?? $kosong !!}</td>
                  </tr>
                  <tr>
                    <td style="width: 35%"><b>Pengajuan</b></td>
                    <td>: {!! Carbon\Carbon::parse($perdinasan->tanggal_ajuan)->isoFormat('dddd, D MMMM Y [pukul] HH:mm') ?? $kosong !!}
                    </td>
                  </tr>
                </table>
                <hr>
                <table class="table table-sm table-borderless">
                  <tr>
                    <td style="width: 35%;"><b>Kategori Dinas</b></td>
                    <td>:
                      {!! $perdinasan->kateg_dinas[0]->jenis_dinas ?? $kosong !!}
                    </td>
                  </tr>
                  <tr>
                    <td style="width: 35%;"><b>Tanggal</b></td>
                    <td>: {!! Carbon\Carbon::parse($perdinasan->tanggal_dinas_awal)->isoFormat('dddd, D MMMM Y') ?? $kosong !!}
                  </tr>
                  <tr>
                    <td style="width: 35%;"><b>Sampai</b></td>
                    <td>: {!! Carbon\Carbon::parse($perdinasan->tanggal_dinas_akhir)->isoFormat('dddd, D MMMM Y') ?? $kosong !!}</td>
                  </tr>
                  <tr>
                    <td style="width: 35%;"><b>Lama Dinas</b></td>
                    <td>: {!! $perdinasan->berapa_lama ?? $kosong !!}</td>
                  </tr>
                  <tr>
                    <td style="width: 35%;"><b>Keperluan</b></td>
                    <td>: {!! $perdinasan->keperluan_dinas ?? $kosong !!}</td>
                  </tr>
                  @if ($perdinasan->bukti != null)
                    <tr>
                      <td style="width: 35%;"><b>Lampiran</b></td>
                      <td>:
                        <span class="text-primary">
                          <a href="/storage/{!! $perdinasan->bukti !!}" target="_blank">Lihat gambar/berkas</a>
                      </td>
                      </p>
                    </tr>
                  @endif
                </table>

                @if ($perdinasan->status == Perdinasan::DI_BATALKAN)
                  <hr>
                  <table class="table table-sm table-borderless">
                    <tr>
                      <td style="width: 35%;"><b>Alasan Batal</b></td>
                      <td>: {!! $perdinasan->setuju_pesan ?? $kosong !!}</td>
                    </tr>
                  </table>
                @endif


                <input type="hidden" id="keperluan_dinas" value="{{ $perdinasan->keperluan_dinas ?? $kosong }}">
                <input type="hidden" id="tanggal_dinas_awal"
                  value="{{ Carbon\Carbon::parse($perdinasan->tanggal_dinas_awal)->isoFormat('dddd, D MMMM Y') ?? $kosong }}">
                <input type="hidden" id="tanggal_dinas_akhir"
                  value="{{ Carbon\Carbon::parse($perdinasan->tanggal_dinas_akhir)->isoFormat('dddd, D MMMM Y') ?? $kosong }}">
              </div>
            </div>
          </div>

          {{-- KOLOM KANAN --}}
          <div class="col-md-5">

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
                  @if ($pimpinan->user_id == $perdinasan->tolak_dari)
                    <span class="text-center badge-outline-merah">
                      Menolak</span>
                  @endif
                </span>
                <p class="text-muted">{{ $pimpinan->nama }}
                  <br>{{ 'NPPY. ' . $pimpinan->nomer_induk }}
                </p>
                {{-- UNTUK TERSETUJUI DARI PIMPINAN --}}
                @if (
                    $perdinasan->setuju_pesan != null && //jika perdinasan ada pesannya &
                        in_array($perdinasan->status, [
                            //jika memiliki status berikut
                            Perdinasan::DI_SETUJUI_PIMPINAN,
                            // Perdinasan::DI_TOLAK,
                        ]))
                  <hr>
                  <div class="row">
                    <div class="col-md-6">
                      <strong>Pesan</strong>
                      <p class="text-muted">{{ $perdinasan->setuju_pesan }}</p>
                    </div>
                    <div class="col-md-6">
                      <strong>TTD</strong>
                      @if ($perdinasan->setuju_dari == $pimpinan->user_id)
                        <span class="text-nowrap" style="color: rgb(14, 164, 14)">valid
                          <i class="ion ion-checkmark"></i>
                        </span>
                        <p class="text-muted">Disahkan pada
                          {{ \Carbon\Carbon::parse($perdinasan->tgl_setuju)->translatedFormat('d F Y') }} pukul
                          {{ \Carbon\Carbon::parse($perdinasan->tgl_setuju)->translatedFormat('H:i') }}
                        </p>
                      @else
                        <span class="text-nowrap" style="color: rgba(0, 0, 0, 0.5)">diwakilkan
                          <i class="ion ion-checkmark"></i>
                        </span>
                        <p class="text-muted">Oleh {{ $perdinasan->setuju_oleh[0]->nama }} pada
                          {{ \Carbon\Carbon::parse($perdinasan->tgl_setuju)->translatedFormat('d F Y') }} pukul
                          {{ \Carbon\Carbon::parse($perdinasan->tgl_setuju)->translatedFormat('H:i') }}
                        </p>
                      @endif
                    </div>
                  </div>
                @endif


                {{-- UNTUK PENOLAKAN OLEH PIMPINAN --}}
                @if (
                    $perdinasan->tolak_pesan != null && //jika ada pesan penolakan &
                        in_array($perdinasan->status, [
                            //jika memiliki status berikut
                            Perdinasan::DI_TOLAK,
                        ]))
                  @if ($perdinasan->tolak_dari == $pimpinan->user_id)
                    {{-- tampilkan hanya jika pimpinan yang menolak --}}
                    <hr>
                    <div class="row">
                      <div class="col-md-6">
                        <strong>Alasan</strong>
                        <p class="text-muted">{{ $perdinasan->tolak_pesan }}</p>
                      </div>
                      <div class="col-md-6">
                        <strong>TTD</strong>
                        @if ($perdinasan->tolak_dari == $pimpinan->user_id)
                          <span class="text-nowrap" style="color: rgb(14, 164, 14)">valid
                            <i class="ion ion-checkmark"></i>
                          </span>
                          <p class="text-muted">Pada tanggal
                            {{ \Carbon\Carbon::parse($perdinasan->tgl_tolak)->translatedFormat('d F Y') }} pukul
                            {{ \Carbon\Carbon::parse($perdinasan->tgl_tolak)->translatedFormat('H:i') }}
                          </p>
                        @else
                          <span class="text-nowrap" style="color: rgba(0, 0, 0, 0.5)">diwakilkan
                            <i class="ion ion-checkmark"></i>
                          </span>
                          <p class="text-muted">Oleh {{ $perdinasan->tolak_oleh[0]->nama }} pada
                            {{ \Carbon\Carbon::parse($perdinasan->tgl_tolak)->translatedFormat('d F Y') }} pukul
                            {{ \Carbon\Carbon::parse($perdinasan->tgl_tolak)->translatedFormat('H:i') }}
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
                $perdinasan->status == Perdinasan::DI_TOLAK &&
                    in_array(auth()->user()->role, [Level_pengguna::IS_SUPERADMIN, Level_pengguna::IS_MANAGER]))
              <div class="card card-default">
                <div class="card-body" style="padding-bottom: 0em">
                  <strong class="mb-0 text-danger"><i class="fas fa-triangle-exclamation mr-2"></i>
                    {{ $perdinasan->tolak_oleh[0]->nama }} Melakukan Penolakan</strong>
                  <div class="row">
                    <div class="col-md-12">
                      <p class="text-muted">Alasan: {{ $perdinasan->tolak_pesan }}
                        @if ($perdinasan->tgl_tolak != null)
                          <br>
                          Pada: {{ \Carbon\Carbon::parse($perdinasan->tgl_tolak)->translatedFormat('d F Y') }} pukul
                          {{ \Carbon\Carbon::parse($perdinasan->tgl_tolak)->translatedFormat('H:i') }}
                        @endif
                      </p>
                    </div>
                  </div>
                </div>
              </div>
            @endif
            <div class="card">
              <div class="card-header">
                <div class="tombol-aksi">
                  @php
                    use Illuminate\Support\Str;
                    $previousUrl = url()->previous();
                    $targetRoute = '';

                    switch ($previousUrl) {
                        //dari perdinasan group
                        case route('perdinasan.index'):
                            $targetRoute = route('perdinasan.index');
                            break;
                        case route('perdinasan.disetujui_pimpinan'):
                            $targetRoute = route('perdinasan.disetujui_pimpinan');
                            break;
                        case route('perdinasan.diizinkan_atasan'):
                            $targetRoute = route('perdinasan.diizinkan_atasan');
                            break;
                        case route('perdinasan.dibatalkan'):
                            $targetRoute = route('perdinasan.dibatalkan');
                            break;
                        case route('perdinasan.diajukan'):
                            $targetRoute = route('perdinasan.diajukan');
                            break;
                        case route('perdinasan.ditolak'):
                            $targetRoute = route('perdinasan.ditolak');
                            break;
                        // Memeriksa URL dengan parameter ID
                        case Str::is(route('presensi.lihat', ['id' => '*']), $previousUrl):
                            // Mengambil ID dari URL sebelumnya
                            $id = last(explode('/', $previousUrl));
                            $targetRoute = route('presensi.lihat', ['id' => $id]);
                            break;
                        // Kalau sama dengan link sebelumnya
                        case $previousUrl === url()->current():
                            $targetRoute = route('perdinasan.index');
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

                  @if ($perdinasan->status == Perdinasan::DI_AJUKAN)
                    {{-- JIKA DIAJUKAN --}}
                    @if (in_array(auth()->user()->role, [Level_pengguna::IS_SUPERADMIN, Level_pengguna::IS_MANAGER]))
                      {{-- Untuk superadmin dan manager --}}
                      <a href="javascript:void(0)" onclick="fn_confirm_terima_pimpinan('/')" id="tombol-setuju"
                        class="btn btn-info float-right ml-2">Setujui
                        <i class="ion ion-android-done-all ml-1"></i></a>
                      <a href="javascript:void(0)" onclick="fn_confirm_tolak_pimpinan('/')" id="tombol-tolak"
                        class="btn btn-secondary float-right">Tolak
                        <i class="ion ion-android-close ml-1"></i></a>
                    @elseif ($perdinasan->pengguna[0]->user_id == auth()->user()->user_id)
                      {{-- Untuk yang bersangkutan --}}
                      <a href="javascript:void(0)" onclick="fn_confirm_batal('/')" id="tombol-batal"
                        class="btn btn-secondary float-right">Batalkan
                        <i class="ion ion-android-remove-circle ml-1"></i>
                      </a>
                    @endif

                    {{-- JIKA DISETUJUI PIMPINAN --}}
                    {{-- JIKA DISETUJUI PIMPINAN --}}
                  @elseif ($perdinasan->status == Perdinasan::DI_SETUJUI_PIMPINAN)
                    @if (in_array(auth()->user()->role, [Level_pengguna::IS_SUPERADMIN, Level_pengguna::IS_MANAGER]))
                      <a onclick="window.print()" class="btn btn-primary float-right ml-2">Cetak
                        <i class="fas fa-print ml-1"></i>
                      </a>
                    @else
                      {{-- Jika pengaju --}}
                      <a onclick="window.print()" class="btn btn-primary float-right ml-2">Cetak
                        <i class="fas fa-print ml-1"></i>
                      </a>
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
    <div class="modal fade" id="konfirmasi-setuju" data-backdrop="static" tabindex="-1"
      aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog ">
        <div class="modal-content">
          <form enctype="multipart/form-data"
            action="{{ route('perdinasan.update', ['perdinasan' => $perdinasan->dinas_id]) }}" method="POST"
            name="form_perdinasan_terima">
            @method('PATCH')
            @csrf
            <div class="modal-header">
              <h5 class="modal-title">Konfirmasi Pimpinan</h5>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
              <div>
                <input type="hidden" name="dinas_id" id="dinas_id" value="{{ $perdinasan->dinas_id }}">
                <input type="hidden" name="status" id="status" value="disetujui_pimpinan">
                <div class="form-group">
                  <p>Anda akan menerima pengajuan dari {{ $perdinasan->pengguna[0]->detail->panggilan }}</p>
                  <textarea class="form-control" name="pesan_terima" id="pesan_terima" rows="4" required
                    value="{{ old('pesan', $perdinasan->pesan) }}" placeholder="Berikan pesan untuknya" maxlength="240"></textarea>
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
    {{-- hampir fix --}}
    <div class="modal fade" id="konfirmasi-tolak" data-backdrop="static" tabindex="-1"
      aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog ">
        <div class="modal-content">
          <form enctype="multipart/form-data"
            action="{{ route('perdinasan.update', ['perdinasan' => $perdinasan->dinas_id]) }}" method="POST"
            name="form_perdinasan_tolak">
            @method('PATCH')
            @csrf
            <div class="modal-header">
              <h5 class="modal-title">Konfirmasi Tolak</h5>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
              <div>
                <p>Anda yakin ingin menolak pengajuan dinas ini?</p>
                <input type="hidden" name="dinas_id" id="dinas_id" value="{{ $perdinasan->dinas_id }}">
                <input type="hidden" name="status" id="status" value="ditolak">
                <div class="form-group">
                  <textarea class="form-control" name="pesan_tolak" id="pesan_tolak" rows="5"
                    value="{{ old('pesan_tolak', $perdinasan->pesan) }}" required placeholder="Alasan penolakan Anda" maxlength="240"></textarea>
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
            action="{{ route('perdinasan.update', ['perdinasan' => $perdinasan->dinas_id]) }}" method="POST"
            name="form_perdinasan_batal">
            @method('PATCH')
            @csrf
            <div class="modal-header">
              <h5 class="modal-title">Konfirmasi</h5>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
              <div>
                <p>Anda yakin ingin membatalkan pengajuan dinas ini?</p>
                <input type="hidden" name="dinas_id" id="dinas_id" value="{{ $perdinasan->dinas_id }}">
                <input type="hidden" name="status" id="status" value="dibatalkan">
                <div class="form-group">
                  <textarea class="form-control" name="pesan" id="pesan" rows="5" required
                    value="{{ old('pesan', $perdinasan->pesan) }}" placeholder="Alasan pembatalan Anda" maxlength="240"></textarea>
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
  {{-- @if (session()->has('diizinkan_atasan'))
    <script>
      iziToast.success({
        title: 'Berhasil.',
        message: '{{ Session('diizinkan_atasan') }}',
        position: 'topCenter'
      });
    </script>
  @endif --}}

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
      $("form[name='form_perdinasan_terima'], form[name='form_perdinasan_izinkan'], form[name='form_perdinasan_tolak'], form[name='form_perdinasan_batal']")
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
      // $('#tombol-setuju').attr('action', url);
      $('#konfirmasi-setuju').modal('show');
    }

    function fn_confirm_tolak_pimpinan(url) {
      // $('#tombol-tolak').attr('action', url);
      $('#konfirmasi-tolak').modal('show');
    }

    /////////////////////////////////////////
    function fn_confirm_batal(url) {
      // $('#tombol-batal').attr('action', url);
      $('#konfirmasi-batal').modal('show');
    }
  </script>
@endsection
