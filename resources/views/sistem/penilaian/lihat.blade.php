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

    @php
      use App\Models\Penilaian;
      use App\Models\Level_pengguna;
      use Carbon\Carbon;

      $kosong = '<i>(Tidak ada data)</i>';
    @endphp

    {{-- Main content --}}
    <section class="content">
      <div class="container">
        <form enctype="multipart/form-data"
          action="{{ route('penilaian.store_update', ['id' => $penilaian->penilaian_id]) }}" method="POST"
          name="penilaian_update">
          @csrf
          {{-- @method('POST') --}}
          <div class="row">
            @if ($penilaian->status == Penilaian::DI_NILAI)
              <div class="col-md-12 order-0 order-md-0">
                <div class="callout callout-info alert alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <i class="fas fa-info-circle mr-2"></i>
                  @if ($ketuaunit->user_id == auth()->user()->user_id)
                    Menunggu penilaian dari Anda
                  @else
                    Menunggu penilaian dari Atasan langsung
                  @endif
                </div>
              </div>
            @elseif ($penilaian->status == Penilaian::DI_NILAI_ATASAN)
              <div class="col-md-12 order-0 order-md-0">
                <div class="callout callout-info alert alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <i class="fas fa-info-circle mr-2"></i>
                  @if (auth()->user()->user_id == $pimpinan->ketuaunit->user_id)
                    Penilaian ini membutuhkan keputusan Anda
                  @else
                    Penilaian ini membutuhkan keputusan Pimpinan
                  @endif
                </div>
              </div>
            @endif
            {{-- kolom samping --}}
            <div class="col-md-4 order-1 order-md-2">
              {{-- card pengaju nilai --}}
              <div class="card card-default">
                <div class="card-body" style="padding-bottom: 0em">
                  <table class="table table-sm table-borderless">
                    <tr>
                      <td style="width: 27%; vertical-align: middle;">Status</td>
                      <td class="text-nowrap" style="vertical-align: middle">:
                        @switch($penilaian->status)
                          @case(Penilaian::DI_TERIMA_PIMP)
                            <p class="badge badge-success mb-0" style=" font-size: 100%;font-weight:400;">
                              <i class="ion ion-android-done-all mx-1"></i>
                              Diterima Pimpinan
                            </p>
                          @break

                          @case(Penilaian::DI_NILAI_ATASAN)
                            <p class="badge badge-secondary mb-0" style=" font-size: 100%;font-weight:400;">
                              <i class="ion ion-android-done mx-1"></i>
                              Dinilai Atasan
                            </p>
                          @break

                          @case(Penilaian::DI_NILAI)
                            <p class="badge badge-secondary mb-0" style=" font-size: 100%;font-weight:400;">
                              <i class="ion ion-android-radio-button-on mx-1"></i>
                              Dibuat
                            </p>
                          @break

                          @case(Penilaian::DI_TOLAK)
                            <p class="badge badge-danger mb-0" style=" font-size: 100%;font-weight:400;">
                              <i class="ion ion-android-close mx-1"></i>
                              Ditolak
                            </p>
                          @break

                          @case(Penilaian::DI_BATALKAN)
                            <p class="badge badge-secondary mb-0" style=" font-size: 100%;font-weight:400;">
                              {{-- <i class="ion ion-android-remove-circle mx-1"></i> --}}
                              <i class="fas fa-ban fa-xs mx-1"></i>
                              Dibatalkan
                            </p>
                          @break

                          @default
                            Status Tidak Diketahui
                        @endswitch
                      </td>
                    </tr>
                    <tr>
                      <td style="width: 27%">Nama</td>
                      {{-- <td>: {!! $penilaian->yg_dinilai[0]->nama !!}</td> --}}
                      <td>: <a href="/pengguna/{{ $penilaian->yg_dinilai[0]->user_id }}"
                        class="text-dark text-bold" data-toggle="tooltip" data-placement="right" title="Lihat profil">{{ $penilaian->yg_dinilai[0]->nama }}</a></td>
                    </tr>
                    <tr>
                      <td style="width: 27%">NPPY</td>
                      <td>: {!! $penilaian->yg_dinilai[0]->nomer_induk !!}</td>
                    </tr>
                    <tr>
                      <td style="width: 27%">Jenis</td>
                      <td>: {!! $penilaian->jenis == 10 ? 'Tendik' : 'Dosen' !!}</td>
                    </tr>
                    <tr>
                      <td style="width: 27%">Periode</td>
                      <td>: {!! $periode !!}</td>
                    </tr>
                    <tr>
                      <td style="width: 27%">Tanggal</td>
                      <td>: {!! Carbon::parse($penilaian->created_at)->isoFormat('dddd, D MMMM Y') !!}
                      </td>
                    </tr>
                    <tr>
                      <td style="width: 27%">Pukul</td>
                      <td>: {!! Carbon::parse($penilaian->created_at)->isoFormat('HH:mm [WIB]') !!}
                      </td>
                    </tr>
                  </table>
                  <p class="text-muted mt-1">
                    <i class="fas fa-signature mr-1"></i>Tanda tangan
                    @if ($penilaian->yg_dinilai[0]->user_id == $penilaian->penginput_by[0]->user_id)
                      <span class="text-nowrap" style="color: rgb(14, 164, 14)">
                        valid <i class="ion ion-checkmark"></i>
                      </span>
                    @else
                      <span class="text-nowrap" style="color: rgba(0, 0, 0, 0.5)">
                        diwakilkan <i class="ion ion-checkmark"></i>
                      </span>
                      oleh {{ $penilaian->penginput_by[0]->nama }}
                    @endif
                  </p>
                </div>
              </div>

              {{-- card atasan langsung --}}
              <div class="card card-default">
                <div class="card-body" style="padding-bottom: 0em">
                  <a><i class="fas fa-circle-user mr-2"></i>Atasan langsung</a>
                  <p class="text-muted">
                    {{ $ketuaunit->nama . ' (' . $ketuaunit->nomer_induk . ')' }}
                    @if ($penilaian->atasan_id != null)
                      <br>
                      Menilai pada
                      {{ \Carbon\Carbon::parse($penilaian->tgl_catatan_atasan)->translatedFormat('d F Y') }} pukul
                      {{ \Carbon\Carbon::parse($penilaian->tgl_catatan_atasan)->translatedFormat('H:i') }}
                      <br>
                      <i class="fas fa-signature mr-1"></i>Tanda tangan
                      @if ($ketuaunit->user_id == $penilaian->atasan_lngsng[0]->user_id)
                        <span class="text-nowrap" style="color: rgb(14, 164, 14)">
                          valid <i class="ion ion-checkmark"></i>
                        </span>
                      @else
                        <span class="text-nowrap" style="color: rgba(0, 0, 0, 0.5)">
                          diwakilkan <i class="ion ion-checkmark"></i>
                        </span>
                        oleh {{ $penilaian->atasan_lngsng[0]->nama }}
                      @endif
                    @endif
                  </p>
                </div>
              </div>

              {{-- card pimpinan --}}
              <div class="card card-default">
                <div class="card-body" style="padding-bottom: 0em">
                  <a><i class="fas fa-circle-user mr-2"></i>Pimpinan</a>
                  ({{ $pimpinan->titel_unit . ' ' . $pimpinan->nama_unit }})
                  <p class="text-muted">
                    {{ $pimpinan->ketuaunit->nama . ' (' . $pimpinan->ketuaunit->nomer_induk . ')' }}
                    @if (
                        $penilaian->catatan_pimpinan != null &&
                            $penilaian->pimpinan_id != null &&
                            // $penilaian->status == Penilaian::DI_TERIMA_PIMP
                            in_array($penilaian->status, [Penilaian::DI_TERIMA_PIMP, Penilaian::DI_TOLAK]))
                      <br>
                      @if ($penilaian->status == Penilaian::DI_TERIMA_PIMP)
                        Diterima pada
                        {{ \Carbon\Carbon::parse($penilaian->tgl_catatan_pimpinan)->translatedFormat('d F Y') }} pukul
                        {{ \Carbon\Carbon::parse($penilaian->tgl_catatan_pimpinan)->translatedFormat('H:i') }}
                        <br>
                        <i class="fas fa-signature mr-1"></i>Tanda tangan
                      @elseif ($penilaian->status == Penilaian::DI_TOLAK)
                        Ditolak pada
                        {{ \Carbon\Carbon::parse($penilaian->tgl_catatan_pimpinan)->translatedFormat('d F Y') }} pukul
                        {{ \Carbon\Carbon::parse($penilaian->tgl_catatan_pimpinan)->translatedFormat('H:i') }}
                        <br>
                        <i class="fas fa-signature mr-1"></i>Tanda stangan
                      @endif
                      @if ($pimpinan->ketuaunit->user_id == $penilaian->pimpinan[0]->user_id)
                        <span class="text-nowrap" style="color: rgb(14, 164, 14)">
                          valid <i class="ion ion-checkmark"></i>
                        </span>
                      @else
                        <span class="text-nowrap" style="color: rgba(0, 0, 0, 0.5)">
                          diwakilkan <i class="ion ion-checkmark"></i>
                        </span>
                        oleh {{ $penilaian->pimpinan[0]->nama }}
                      @endif
                    @endif
                  </p>
                </div>
              </div>
              {{-- END CARD --}}
            </div>

            {{-- kolom kanan --}}
            <div class="col-md-8 order-2 order-md-1">
              <div class="card card-default">
                <div class="card-header">
                  <h3 class="card-title">Hasil Penilaian</h3>
                  <span class="text-nowrap mx-1">
                    <span class="badge badge-success" id="id_rata_rata_keseluruhan" style="font-size: 100%">
                      {{ $penilaian->avg_semua ?? '' }}
                    </span>
                  </span>
                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                      <i class="fas fa-minus"></i>
                    </button>
                  </div>
                </div>
                <div class="card-body">
                  <div style="overflow-x: auto;">
                    <table class="table table-sm table-borderless">
                      <tbody>
                        <tr>
                          <td class="text-nowrap" style="width: 50%; vertical-align: middle;">1. Disiplin</td>
                          <td class="text-nowrap" style="width: 20%; vertical-align: middle;">
                            <span>Pribadi</span>: <span class="badge badge-success" id="id_nilai_1a"
                              style="font-size: 92%">{{ $penilaian->nilai_1a ?? '' }}</span>
                          </td>
                          @if ($penilaian->nilai_1b)
                            <td class="text-nowrap" style="width: 20%; vertical-align: middle;">
                              <span>Atasan</span>: <span class="badge badge-success" id="id_nilai_1b"
                                style="font-size: 92%">{{ $penilaian->nilai_1b ?? '' }}</span>
                            </td>
                          @endif
                        </tr>
                        <tr>
                          <td class="text-nowrap" style="vertical-align: middle;">2. Etika</td>
                          <td class="text-nowrap" style="vertical-align: middle;">
                            <span>Pribadi</span>: <span class="badge badge-success" id="id_nilai_2a"
                              style="font-size: 92%">{{ $penilaian->nilai_2a ?? '' }}</span>
                          </td>
                          @if ($penilaian->nilai_2b)
                            <td class="text-nowrap" style="vertical-align: middle;">
                              <span>Atasan</span>: <span class="badge badge-success" id="id_nilai_2b"
                                style="font-size: 92%">{{ $penilaian->nilai_2b ?? '' }}</span>
                            </td>
                          @endif
                        </tr>
                        <tr>
                          <td class="text-nowrap" style="vertical-align: middle;">3. Tanggungjawab</td>
                          <td class="text-nowrap" style="vertical-align: middle;">
                            <span>Pribadi</span>: <span class="badge badge-success" id="id_nilai_3a"
                              style="font-size: 92%">{{ $penilaian->nilai_3a ?? '' }}</span>
                          </td>
                          @if ($penilaian->nilai_3b)
                            <td class="text-nowrap" style="vertical-align: middle;">
                              <span>Atasan</span>: <span class="badge badge-success" id="id_nilai_3b"
                                style="font-size: 92%">{{ $penilaian->nilai_3b ?? '' }}</span>
                            </td>
                          @endif
                        </tr>
                        <tr>
                          <td class="text-nowrap" style="vertical-align: middle;">4. Kerjasama</td>
                          <td class="text-nowrap" style="vertical-align: middle;">
                            <span>Pribadi</span>: <span class="badge badge-success" id="id_nilai_4a"
                              style="font-size: 92%">{{ $penilaian->nilai_4a ?? '' }}</span>
                          </td>
                          @if ($penilaian->nilai_4b)
                            <td class="text-nowrap" style="vertical-align: middle;">
                              <span>Atasan</span>: <span class="badge badge-success" id="id_nilai_4b"
                                style="font-size: 92%">{{ $penilaian->nilai_4b ?? '' }}</span>
                            </td>
                          @endif
                        </tr>
                        <tr>
                          <td class="text-nowrap" style="vertical-align: middle;">5. Prestasi kerja</td>
                          <td class="text-nowrap" style="vertical-align: middle;">
                            <span>Pribadi</span>: <span class="badge badge-success" id="id_nilai_5a"
                              style="font-size: 92%">{{ $penilaian->nilai_5a ?? '' }}</span>
                          </td>
                          @if ($penilaian->nilai_5b)
                            <td class="text-nowrap" style="vertical-align: middle;">
                              <span>Atasan</span>: <span class="badge badge-success" id="id_nilai_5b"
                                style="font-size: 92%">{{ $penilaian->nilai_5b ?? '' }}</span>
                            </td>
                          @endif
                        </tr>

                        @if ($penilaian->jenis == 11)
                          <tr>
                            <td class="text-nowrap" style="vertical-align: middle;">6. Penguatan materi pembelajaran
                            </td>
                            <td class="text-nowrap" style="vertical-align: middle;">
                              <span>Pribadi</span>: <span class="badge badge-success" id="id_nilai_5a"
                                style="font-size: 92%">{{ $penilaian->nilai_6a ?? '' }}</span>
                            </td>
                            @if ($penilaian->nilai_6b)
                              <td class="text-nowrap" style="vertical-align: middle;">
                                <span>Atasan</span>: <span class="badge badge-success" id="id_nilai_5b"
                                  style="font-size: 92%">{{ $penilaian->nilai_6b ?? '' }}</span>
                              </td>
                            @endif
                          </tr>
                          <tr>
                            <td class="text-nowrap" style="vertical-align: middle;">7. Inovasi
                            </td>
                            <td class="text-nowrap" style="vertical-align: middle;">
                              <span>Pribadi</span>: <span class="badge badge-success" id="id_nilai_5a"
                                style="font-size: 92%">{{ $penilaian->nilai_7a ?? '' }}</span>
                            </td>
                            @if ($penilaian->nilai_7b)
                              <td class="text-nowrap" style="vertical-align: middle;">
                                <span>Atasan</span>: <span class="badge badge-success" id="id_nilai_5b"
                                  style="font-size: 92%">{{ $penilaian->nilai_7b ?? '' }}</span>
                              </td>
                            @endif
                          </tr>
                          <tr>
                            <td class="text-nowrap" style="vertical-align: middle;">8. Penelitian
                            </td>
                            <td class="text-nowrap" style="vertical-align: middle;">
                              <span>Pribadi</span>: <span class="badge badge-success" id="id_nilai_5a"
                                style="font-size: 92%">{{ $penilaian->nilai_8a ?? '' }}</span>
                            </td>
                            @if ($penilaian->nilai_8b)
                              <td class="text-nowrap" style="vertical-align: middle;">
                                <span>Atasan</span>: <span class="badge badge-success" id="id_nilai_5b"
                                  style="font-size: 92%">{{ $penilaian->nilai_8b ?? '' }}</span>
                              </td>
                            @endif
                          </tr>
                          <tr>
                            <td class="text-nowrap" style="vertical-align: middle;">9. Pengabdian masyarakat
                            </td>
                            <td class="text-nowrap" style="vertical-align: middle;">
                              <span>Pribadi</span>: <span class="badge badge-success" id="id_nilai_5a"
                                style="font-size: 92%">{{ $penilaian->nilai_9a ?? '' }}</span>
                            </td>
                            @if ($penilaian->nilai_9b)
                              <td class="text-nowrap" style="vertical-align: middle;">
                                <span>Atasan</span>: <span class="badge badge-success" id="id_nilai_5b"
                                  style="font-size: 92%">{{ $penilaian->nilai_9b ?? '' }}</span>
                              </td>
                            @endif
                          </tr>
                        @endif
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>

              @php
                $lastDate = null; // Menyimpan tanggal sebelumnya
              @endphp
              <div class="card card-default">
                <div class="card-header" style="vertical-align: middle">
                  <h3 class="card-title">Linimasa Penilaian</h3>
                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                      <i class="fas fa-minus"></i>
                    </button>
                  </div>
                </div>
                <div class="card-body">
                  <div class="timeline timeline-inverse">
                    {{-- Timeline for Pembuatan Penilaian --}}
                    @php
                      $createdDate = Carbon::parse($penilaian->created_at)->format('d M Y');
                    @endphp
                    {{-- Cek apakah tanggal berbeda dari tanggal sebelumnya --}}
                    @if ($lastDate !== $createdDate)
                      {{-- Buat time-label baru --}}
                      <div class="time-label">
                        <span class="bg-gradient-secondary"
                          style="padding: 2px 0.8rem; border-radius: 1rem; font-weight:500">
                          {{ $createdDate }}
                        </span>
                      </div>
                      @php
                        $lastDate = $createdDate; // Update tanggal terakhir
                      @endphp
                    @endif

                    {{-- timeline item --}}
                    <div style="margin-right: 0rem">
                      <img class="timeline-avatar" style="top:5px"
                        src="/storage/{{ $penilaian->penginput_by[0]->detail->foto }}">
                      <div class="timeline-item" style="margin-right: 0rem">
                        <span class="time"><i
                            class="far fa-clock mr-1"></i>{{ Carbon::parse($penilaian->created_at)->diffForHumans() }}</span>
                        <h3 class="timeline-header">
                          <strong>{{ $penilaian->penginput_by[0]->nama }} </strong>
                        </h3>
                        <div class="timeline-body">
                          Membuat penilaian
                        </div>
                      </div>
                    </div>

                    {{-- Timeline for Catatan Atasan --}}
                    @if ($penilaian->catatan_atasan && $penilaian->atasan_id)
                      @php
                        $atasanDate = Carbon::parse($penilaian->tgl_catatan_atasan)->format('d M Y');
                      @endphp
                      {{-- Cek apakah tanggal berbeda dari tanggal terakhir --}}
                      @if ($lastDate !== $atasanDate)
                        {{-- Buat time-label baru --}}
                        <div class="time-label">
                          <span class="bg-gradient-secondary"
                            style="padding: 2px 0.8rem; border-radius: 1rem; font-weight:500">
                            {{ $atasanDate }}
                          </span>
                        </div>
                        @php
                          $lastDate = $atasanDate; // Update tanggal terakhir
                        @endphp
                      @endif
                      {{-- timeline item --}}
                      <div style="margin-right: 0rem">
                        <img class="timeline-avatar" style="top:5px"
                          src="/storage/{{ $penilaian->atasan_lngsng[0]->detail->foto }}">
                        <div class="timeline-item" style="margin-right: 0rem">
                          <span class="time"><i
                              class="far fa-clock mr-1"></i>{{ Carbon::parse($penilaian->tgl_catatan_atasan)->diffForHumans() }}</span>
                          <h3 class="timeline-header">
                            <strong>{{ $penilaian->atasan_lngsng[0]->nama }}</strong>
                            menilai
                          </h3>
                          <div class="timeline-body">
                            <p>
                              Catatan Atasan: <br>
                              {{ $penilaian->catatan_atasan ?? '' }} </p>
                            @if (
                                $penilaian->ket_nilai_1 ||
                                    $penilaian->ket_nilai_2 ||
                                    $penilaian->ket_nilai_3 ||
                                    $penilaian->ket_nilai_4 ||
                                    $penilaian->ket_nilai_5 ||
                                    $penilaian->ket_nilai_6 ||
                                    $penilaian->ket_nilai_7 ||
                                    $penilaian->ket_nilai_8 ||
                                    $penilaian->ket_nilai_9)
                              Keterangan Tambahan: <br>
                              {!! $penilaian->ket_nilai_1 ? '<b>1. Disiplin : </b>' . $penilaian->ket_nilai_1 . '<br>' : '' !!}
                              {!! $penilaian->ket_nilai_2 ? '<b>2. Etika : </b>' . $penilaian->ket_nilai_2 . '<br>' : '' !!}
                              {!! $penilaian->ket_nilai_3 ? '<b>3. Tanggungjawab : </b>' . $penilaian->ket_nilai_3 . '<br>' : '' !!}
                              {!! $penilaian->ket_nilai_4 ? '<b>4. Kerjasama : </b>' . $penilaian->ket_nilai_4 . '<br>' : '' !!}
                              {!! $penilaian->ket_nilai_5 ? '<b>5. Prestasi kerja : </b>' . $penilaian->ket_nilai_5 . '<br>' : '' !!}
                              {!! $penilaian->ket_nilai_6
                                  ? '<b>6. Penguatan materi pembelajaran : </b>' . $penilaian->ket_nilai_6 . '<br>'
                                  : '' !!}
                              {!! $penilaian->ket_nilai_7 ? '<b>7. Inovasi : </b>' . $penilaian->ket_nilai_7 . '<br>' : '' !!}
                              {!! $penilaian->ket_nilai_8 ? '<b>8. Penelitian : </b>' . $penilaian->ket_nilai_8 . '<br>' : '' !!}
                              {!! $penilaian->ket_nilai_9 ? '<b>9. Pengabdian masyarakat : </b>' . $penilaian->ket_nilai_9 . '<br>' : '' !!}
                            @endif
                            </p>
                          </div>
                        </div>
                      </div>
                    @endif

                    {{-- Timeline for Keputusan Pimpinan --}}
                    @if ($penilaian->catatan_pimpinan && $penilaian->pimpinan_id)
                      @php
                        $pimpinanDate = Carbon::parse($penilaian->tgl_catatan_pimpinan)->format('d M Y');
                      @endphp
                      {{-- Cek apakah tanggal berbeda dari tanggal terakhir --}}
                      @if ($lastDate !== $pimpinanDate)
                        {{-- Buat time-label baru --}}
                        <div class="time-label">
                          <span class="bg-gradient-secondary"
                            style="padding: 2px 0.8rem; border-radius: 1rem; font-weight:500">
                            {{ $pimpinanDate }}
                          </span>
                        </div>
                        @php
                          $lastDate = $pimpinanDate; // Update tanggal terakhir
                        @endphp
                      @endif
                      {{-- timeline item --}}
                      <div style="margin-right: 0rem">
                        <img class="timeline-avatar" style="top:5px"
                          src="/storage/{{ $penilaian->pimpinan[0]->detail->foto }}">
                        <div class="timeline-item" style="margin-right: 0rem">
                          <span class="time"><i
                              class="far fa-clock mr-1"></i>{{ Carbon::parse($penilaian->tgl_catatan_pimpinan)->diffForHumans() }}</span>
                          <h3 class="timeline-header">
                            <strong>{{ $penilaian->pimpinan[0]->nama }}</strong>
                            memutuskan
                          </h3>
                          <div class="timeline-body">
                            <p>
                              Catatan Pimpinan: <br>
                              {{ $penilaian->catatan_pimpinan ?? '' }} </p>
                            </p>
                          </div>
                        </div>
                      </div>
                    @endif



                    {{-- timeline item --}}
                    {{-- <div style="margin-right: 0rem">
                      <i class="fas fa-user bg-info"></i>
                      <div class="timeline-item" style="margin-right: 0rem">
                        <span class="time"><i class="far fa-clock"></i> 5 mins ago</span>
                        <h3 class="timeline-header border-0"><a href="#">Sarah Young</a>
                          accepted your friend request
                        </h3>
                      </div>
                    </div> --}}


                    @if (
                        // FORM PENILAIAN ATASAN
                        !empty($penilaian->yg_dinilai_id) && // harus ada yg_dinilai_id
                            empty($penilaian->atasan_id) && // harus kosong atasan _id   /// dan atasan_id adalah userid yg login
                            !in_array($penilaian->status, [Penilaian::DI_BATALKAN, Penilaian::DI_TOLAK]) && // Tidak boleh jika 'DIBATALKAN' & 'DITOLAK'
                            $ketuaunit->user_id == auth()->user()->user_id)
                      <div class="row d-flex pt-3">
                        <div class="col-md-12">
                          <div class="row">
                            <div class="col-md-12">
                              {{-- 1. PENILAIAN ATASAN --}}
                              <div class="card">
                                <div class="card-header">
                                  <h3 class="card-title"><b>Penilaian Atasan</b></h3>
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
                                        <td style="width: 20%; vertical-align: middle;">
                                          <div class="form-group mb-0">
                                            <input type="text"
                                              class="form-control @error('nilai_1b') is-invalid @enderror"
                                              id="nilai_1b" name="nilai_1b" value="{{ old('nilai_1b') }}"
                                              placeholder="Nilai">
                                            @error('nilai_1b')
                                              <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                          </div>
                                        </td>
                                        <td>
                                          <div class="form-group mb-0">
                                            <input type="text"
                                              class="form-control @error('ket_nilai_1') is-invalid @enderror"
                                              id="ket_nilai_1" name="ket_nilai_1" value="{{ old('ket_nilai_1') }}"
                                              placeholder="Keterangan">
                                            @error('ket_nilai_1')
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
                                              class="form-control @error('nilai_2b') is-invalid @enderror"
                                              id="nilai_2b" name="nilai_2b" value="{{ old('nilai_2b') }}"
                                              placeholder="Nilai">
                                            @error('nilai_2b')
                                              <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                          </div>
                                        </td>
                                        <td>
                                          <div class="form-group mb-0">
                                            <input type="text"
                                              class="form-control @error('ket_nilai_2') is-invalid @enderror"
                                              id="ket_nilai_2" name="ket_nilai_2" value="{{ old('ket_nilai_2') }}"
                                              placeholder="Keterangan">
                                            @error('ket_nilai_2')
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
                                              class="form-control @error('nilai_3b') is-invalid @enderror"
                                              id="nilai_3b" name="nilai_3b" value="{{ old('nilai_3b') }}"
                                              placeholder="Nilai">
                                            @error('nilai_3b')
                                              <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                          </div>
                                        </td>
                                        <td>
                                          <div class="form-group mb-0">
                                            <input type="text"
                                              class="form-control @error('ket_nilai_3') is-invalid @enderror"
                                              id="ket_nilai_3" name="ket_nilai_3" value="{{ old('ket_nilai_3') }}"
                                              placeholder="Keterangan">
                                            @error('ket_nilai_3')
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
                                              class="form-control @error('nilai_4b') is-invalid @enderror"
                                              id="nilai_4b" name="nilai_4b" value="{{ old('nilai_4b') }}"
                                              placeholder="Nilai">
                                            @error('nilai_4b')
                                              <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                          </div>
                                        </td>
                                        <td>
                                          <div class="form-group mb-0">
                                            <input type="text"
                                              class="form-control @error('ket_nilai_4') is-invalid @enderror"
                                              id="ket_nilai_4" name="ket_nilai_4" value="{{ old('ket_nilai_4') }}"
                                              placeholder="Keterangan">
                                            @error('ket_nilai_4')
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
                                              class="form-control @error('nilai_5b') is-invalid @enderror"
                                              id="nilai_5b" name="nilai_5b" value="{{ old('nilai_5b') }}"
                                              placeholder="Nilai">
                                            @error('nilai_5b')
                                              <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                          </div>
                                        </td>
                                        <td>
                                          <div class="form-group mb-0">
                                            <input type="text"
                                              class="form-control @error('ket_nilai_5') is-invalid @enderror"
                                              id="ket_nilai_5" name="ket_nilai_5" value="{{ old('ket_nilai_5') }}"
                                              placeholder="Keterangan">
                                            @error('ket_nilai_5')
                                              <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                          </div>
                                        </td>
                                      </tr>



                                      @if ($penilaian->jenis == 11)
                                        <tr>
                                          <td style="width: 45%; vertical-align: middle;">6. Penguatan materi
                                            pembelajaran
                                          </td>
                                          <td style="vertical-align: middle;">
                                            <div class="form-group mb-0">
                                              <input type="text"
                                                class="form-control @error('nilai_6b') is-invalid @enderror"
                                                id="nilai_6b" name="nilai_6b" value="{{ old('nilai_6b') }}"
                                                placeholder="Nilai">
                                              @error('nilai_6b')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                              @enderror
                                            </div>
                                          </td>
                                          <td>
                                            <div class="form-group mb-0">
                                              <input type="text"
                                                class="form-control @error('ket_nilai_6') is-invalid @enderror"
                                                id="ket_nilai_6" name="ket_nilai_6" value="{{ old('ket_nilai_6') }}"
                                                placeholder="Keterangan">
                                              @error('ket_nilai_6')
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
                                                class="form-control @error('nilai_7b') is-invalid @enderror"
                                                id="nilai_7b" name="nilai_7b" value="{{ old('nilai_7b') }}"
                                                placeholder="Nilai">
                                              @error('nilai_7b')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                              @enderror
                                            </div>
                                          </td>
                                          <td>
                                            <div class="form-group mb-0">
                                              <input type="text"
                                                class="form-control @error('ket_nilai_7') is-invalid @enderror"
                                                id="ket_nilai_7" name="ket_nilai_7" value="{{ old('ket_nilai_7') }}"
                                                placeholder="Keterangan">
                                              @error('ket_nilai_7')
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
                                                class="form-control @error('nilai_8b') is-invalid @enderror"
                                                id="nilai_8b" name="nilai_8b" value="{{ old('nilai_8b') }}"
                                                placeholder="Nilai">
                                              @error('nilai_8b')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                              @enderror
                                            </div>
                                          </td>
                                          <td>
                                            <div class="form-group mb-0">
                                              <input type="text"
                                                class="form-control @error('ket_nilai_8') is-invalid @enderror"
                                                id="ket_nilai_8" name="ket_nilai_8" value="{{ old('ket_nilai_8') }}"
                                                placeholder="Keterangan">
                                              @error('ket_nilai_8')
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
                                                class="form-control @error('nilai_9b') is-invalid @enderror"
                                                id="nilai_9b" name="nilai_9b" value="{{ old('nilai_9b') }}"
                                                placeholder="Nilai">
                                              @error('nilai_9b')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                              @enderror
                                            </div>
                                          </td>
                                          <td>
                                            <div class="form-group mb-0">
                                              <input type="text"
                                                class="form-control @error('ket_nilai_9') is-invalid @enderror"
                                                id="ket_nilai_9" name="ket_nilai_9" value="{{ old('ket_nilai_9') }}"
                                                placeholder="Keterangan">
                                              @error('ket_nilai_9')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                              @enderror
                                            </div>
                                          </td>
                                        </tr>
                                      @endif
                                    </table>

                                    <div class="col-md-12">
                                      <div class="form-group">
                                        <label for="catatan_atasan" class="col-form-label">Catatan Anda</label>
                                        <textarea class="form-control @error('catatan_atasan') is-invalid @enderror" id="catatan_atasan"
                                          name="catatan_atasan" rows="6"
                                          placeholder="Berikan catatan penilaian untuk {{ $penilaian->yg_dinilai[0]->nama }}">{{ old('catatan_atasan') }}</textarea>
                                        @error('catatan_atasan')
                                          <div class="invalid-feedback"> {{ $message }} </div>
                                        @enderror
                                      </div>
                                    </div>

                                    <div class="col-md-12">
                                      <div class="form-group">
                                        <div class="icheck-primary ">
                                          <input type="checkbox" id="ttd" name="ttd_atasan"
                                            class="@error('ttd_atasan')is-invalid @enderror"
                                            {{ old('ttd_atasan') == 'on' ? 'checked' : '' }}>
                                          <label for="ttd">Tanda tangan</label>
                                          <span> dengan ini saya menyatakan penilaian ini adalah sah.</span>
                                          @error('ttd_atasan')
                                            <div class="invalid-feedback"> {{ $message }} </div>
                                          @enderror
                                        </div>

                                        {{-- hidden input --}}
                                        {{-- hidden input --}}
                                        {{-- hidden input --}}
                                        <input hidden type="text"
                                          class="form-control @error('penilaian_id')is-invalid @enderror"
                                          id="penilaian_id" name="penilaian_id"
                                          value="{{ $penilaian->penilaian_id }}">
                                        @error('penilaian_id')
                                          <div class="invalid-feedback"> {{ $message }} </div>
                                        @enderror
                                        {{-- hidden input --}}
                                        <input hidden type="number"
                                          class="form-control @error('jenis')is-invalid @enderror" id="jenis"
                                          name="jenis" value="{{ $penilaian->jenis }}">
                                        @error('jenis')
                                          <div class="invalid-feedback"> {{ $message }} </div>
                                        @enderror
                                        {{-- hidden input --}}
                                        <input hidden type="text"
                                          class="form-control @error('status')is-invalid @enderror" id="status"
                                          name="status" placeholder="status">
                                        @error('status')
                                          <div class="invalid-feedback"> {{ $message }} </div>
                                        @enderror
                                        {{-- hidden input --}}
                                        <input hidden type="text"
                                          class="form-control @error('tgl_catatan_atasan')is-invalid @enderror"
                                          id="tgl_catatan_atasan" name="tgl_catatan_atasan"
                                          placeholder="tgl_catatan_atasan">
                                        @error('tgl_catatan_atasan')
                                          <div class="invalid-feedback"> {{ $message }} </div>
                                        @enderror
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                            {{-- END --}}
                          </div>
                        </div>
                      </div>
                    @endif

                    @if (
                        // FORM KEPUTUSAN PIMPINAN
                        !empty($penilaian->atasan_id) && // harus ada yg_dinilai_id
                            empty($penilaian->pimpinan_id) && // pimpinan_id harus kosong
                            $penilaian->status !== in_array($penilaian->status, [Penilaian::DI_BATALKAN, Penilaian::DI_TOLAK]) && // Tidak boleh jika status 'DIBATALKAN' & 'DITOLAK'
                            !empty($penilaian->catatan_atasan) && // harus ada catatan penilaian atasan
                            $pimpinan->ketuaunit->user_id == auth()->user()->user_id)
                      <div class="row d-flex pt-3">
                        <div class="col-md-12">
                          <div class="row">
                            <div class="col-md-12">
                              {{-- 2. KEPUTUSAN PIMPINAN --}}
                              <div class="card">
                                <div class="card-header">
                                  <h3 class="card-title"><b>Keputusan Pimpinan</b></h3>
                                  <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                      <i class="fas fa-minus"></i>
                                    </button>
                                  </div>
                                </div>
                                <div class="card-body">
                                  <div class="row d-flex">
                                    {{-- Form pimpinan --}}
                                    <div class="col-md-12">
                                      <div class="form-group">
                                        {{-- <label for="catatan_pimpinan" class="col-form-label">Catatan Pimpinan</label> --}}
                                        <div class="form-group ">
                                          <div
                                            class="btn-group btn-group-toggle @error('keputusan') is-invalid @enderror"
                                            data-toggle="buttons">
                                            <label
                                              class="btn btn-sm btn-outline-success {{ old('keputusan') == '10' ? 'active' : '' }}">
                                              <input type="radio" name="keputusan" id="keputusan_terima"
                                                value="terima" {{ old('keputusan') == '10' ? 'checked' : '' }}
                                                autocomplete="off">
                                              Terima
                                            </label>
                                            <label
                                              class="btn btn-sm btn-outline-danger {{ old('keputusan') == '11' ? 'active' : '' }}">
                                              <input type="radio" name="keputusan" id="keputusan_tolak"
                                                value="tolak" {{ old('keputusan') == '11' ? 'checked' : '' }}
                                                autocomplete="off">
                                              Tolak
                                            </label>
                                          </div>
                                          @error('keputusan')
                                            <div class="invalid-feedback"> {{ $message }} </div>
                                          @enderror
                                        </div>
                                        <textarea class="form-control @error('catatan_pimpinan') is-invalid @enderror" id="catatan_pimpinan"
                                          name="catatan_pimpinan" rows="5"
                                          placeholder="Berikan keputusan untuk penilaian a.n {{ $penilaian->yg_dinilai[0]->nama }}">{{ old('catatan_pimpinan') }}</textarea>
                                        @error('catatan_pimpinan')
                                          <div class="invalid-feedback"> {{ $message }} </div>
                                        @enderror
                                      </div>
                                    </div>

                                    <div class="col-md-12">
                                      <div class="form-group">
                                        <div class="icheck-primary ">
                                          <input type="checkbox" id="ttd_pimpinan" name="ttd_pimpinan"
                                            class="@error('ttd_pimpinan')is-invalid @enderror"
                                            {{ old('ttd_pimpinan') == 'on' ? 'checked' : '' }}>
                                          <label for="ttd_pimpinan">Tanda tangan</label>
                                          <span> saya menyatakan keputusan ini adalah mutlak dan sah.</span>
                                          @error('ttd_pimpinan')
                                            <div class="invalid-feedback"> {{ $message }} </div>
                                          @enderror
                                        </div>

                                        {{-- hidden input --}}
                                        {{-- hidden input --}}
                                        {{-- hidden input --}}
                                        <input hidden type="text"
                                          class="form-control @error('penilaian_id')is-invalid @enderror"
                                          id="penilaian_id" name="penilaian_id"
                                          value="{{ $penilaian->penilaian_id }}">
                                        @error('penilaian_id')
                                          <div class="invalid-feedback"> {{ $message }} </div>
                                        @enderror
                                        {{-- hidden input --}}
                                        <input hidden type="number"
                                          class="form-control @error('jenis')is-invalid @enderror" id="jenis"
                                          name="jenis" value="{{ $penilaian->jenis }}">
                                        @error('jenis')
                                          <div class="invalid-feedback"> {{ $message }} </div>
                                        @enderror
                                        {{-- hidden input --}}
                                        <input hidden type="text"
                                          class="form-control @error('status')is-invalid @enderror" id="status"
                                          name="status" placeholder="status">
                                        @error('status')
                                          <div class="invalid-feedback"> {{ $message }} </div>
                                        @enderror
                                        {{-- hidden input --}}
                                        <input hidden type="text"
                                          class="form-control @error('tgl_catatan_pimpinan')is-invalid @enderror"
                                          id="tgl_catatan_pimpinan" name="tgl_catatan_pimpinan"
                                          placeholder="tgl_catatan_pimpinan">
                                        @error('tgl_catatan_pimpinan')
                                          <div class="invalid-feedback"> {{ $message }} </div>
                                        @enderror
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                            {{-- END --}}
                          </div>
                        </div>
                      </div>
                    @endif

                    {{-- Timeline for Status DIBATALKAN, DITOLAK dan DITERIMA --}}
                    @if (in_array($penilaian->status, [Penilaian::DI_BATALKAN, Penilaian::DI_TOLAK, Penilaian::DI_TERIMA_PIMP]))
                      @php
                        $finalDate = Carbon::parse($penilaian->updated_at)->format('d M Y');
                      @endphp
                      {{-- Cek apakah tanggal berbeda dari tanggal terakhir --}}
                      @if ($lastDate !== $finalDate)
                        {{-- Buat time-label baru --}}
                        <div class="time-label">
                          <span class="bg-gradient-secondary"
                            style="padding: 2px 0.8rem; border-radius: 1rem; font-weight:500">
                            {{ $finalDate }}
                          </span>
                        </div>
                        @php
                          $lastDate = $finalDate; // Update tanggal terakhir
                        @endphp
                      @endif
                      {{-- timeline item --}}
                      <div style="margin-right: 0rem">
                        @if ($penilaian->status == Penilaian::DI_BATALKAN)
                          <i class="fas fa-ban fa-xs bg-secondary" style="top:5px"></i>
                          <div class="timeline-item" style="margin-right: 0rem">
                            <span class="time">
                              <i class="far fa-clock mr-1"></i>
                              {{ Carbon::parse($penilaian->updated_at)->diffForHumans() }}</span>
                            <h3 class="timeline-header ">
                              <strong">Penilaian Dibatalkan</strong>
                            </h3>
                          </div>
                        @elseif ($penilaian->status == Penilaian::DI_TERIMA_PIMP)
                          <i class="ion ion-checkmark-circled bg-success" style="top:5px"></i>
                          <div class="timeline-item" style="margin-right: 0rem">
                            <span class="time">
                              <i class="far fa-clock mr-1"></i>
                              {{ Carbon::parse($penilaian->updated_at)->diffForHumans() }}</span>
                            <h3 class="timeline-header">
                              <strong class="text-success">Penilaian Diterima Pimpinan</strong>
                            </h3>
                          </div>
                        @elseif ($penilaian->status == Penilaian::DI_TOLAK)
                          <i class="ion ion-close-circled bg-danger" style="top:5px"></i>
                          <div class="timeline-item" style="margin-right: 0rem">
                            <span class="time">
                              <i class="far fa-clock mr-1"></i>
                              {{ Carbon::parse($penilaian->updated_at)->diffForHumans() }}</span>
                            <h3 class="timeline-header">
                              <strong class="text-danger">Penilaian Ditolak</strong>
                            </h3>
                          </div>
                        @endif
                        {{-- END of status --}}
                      </div>
                    @endif

                    {{-- END timeline item --}}
                    @if (in_array($penilaian->status, [Penilaian::DI_BATALKAN, Penilaian::DI_TOLAK, Penilaian::DI_TERIMA_PIMP]))
                      <div class="text-sm">
                        <i class="fas" style="height: 12px; width:12px; top:-10px; left:27px; color: #dee2e6"></i>
                      </div>
                    @else
                      <div>
                        <i class="fas fa-clock bg-secondary"></i>
                      </div>
                    @endif
                  </div>
                </div>


                {{-- tombol submit --}}
                <div class="card-footer">
                  <div>
                    @php
                      use Illuminate\Support\Str;
                      $previousUrl = url()->previous();
                      $targetRoute = '';

                      switch ($previousUrl) {
                          //dari percutian group
                          case route('penilaian.index'):
                              $targetRoute = route('penilaian.index');
                              break;
                          case route('penilaian.semua'):
                              $targetRoute = route('penilaian.semua');
                              break;
                          case route('penilaian.dinilaiatasan'):
                              $targetRoute = route('penilaian.dinilaiatasan');
                              break;
                          case route('penilaian.diterima'):
                              $targetRoute = route('penilaian.diterima');
                              break;
                          case route('penilaian.ditolak'):
                              $targetRoute = route('penilaian.ditolak');
                              break;
                          case route('penilaian.dibatalkan'):
                              $targetRoute = route('penilaian.dibatalkan');
                              break;
                          // Kalau sama dengan link sebelumnya
                          case $previousUrl === url()->current():
                              $targetRoute = route('penilaian.index');
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


                    {{-- Batalkan --}}
                    @if ($penilaian->status == Penilaian::DI_NILAI && $penilaian->yg_dinilai_id == auth()->user()->user_id)
                      {{-- hidden input --}}
                      <input hidden type="text" class="form-control @error('perintah_batalkan')is-invalid @enderror"
                        id="perintah_batalkan" name="perintah_batalkan" value="batalkan_segera">
                      {{-- hidden input --}}
                      <input hidden type="text" class="form-control @error('penilaian_id')is-invalid @enderror"
                        id="penilaian_id" name="penilaian_id" value="{{ $penilaian->penilaian_id }}">
                      <button type="submit" href="javascript:void(0)" id="tombol-batal"
                        class="btn btn-secondary float-right">Batalkan
                        <i class="ion ion-android-remove-circle ml-1"></i>
                      </button>
                    @elseif (
                        !empty($penilaian->yg_dinilai_id) && // harus ada yg_dinilai_id
                            empty($penilaian->pimpinan_id) && // tidak boleh ada pimpinan_id + opsional
                            empty($penilaian->atasan_id) && // harus kosong atasan _id  /// dan atasan_id adalah userid yg login
                            !in_array($penilaian->status, [Penilaian::DI_BATALKAN, Penilaian::DI_TOLAK, Penilaian::DI_TERIMA_PIMP]) && // Tidak boleh jika 'DIBATALKAN' & 'DITOLAK'
                            $ketuaunit->user_id == auth()->user()->user_id)
                      <button type="submit" id="tombol-kirim" class="btn btn-primary float-right">Kirim Nilai
                        <i class="fa-solid fa-paper-plane ml-1"></i>
                      </button>
                    @elseif(!empty($penilaian->avg_nilai_b) && empty($penilaian->pimpinan_id))
                      {{-- // harus ada nilai dari atasan & tidak boleh ada keputusan pimpinan --}}
                      <button type="submit" id="beri_keputusan" class="btn btn-primary float-right" disabled>Beri
                        Keputusan<i class="fa-solid fa-check ml-1"></i>
                      </button>
                    @elseif(!empty($penilaian->pimpinan_id) && $penilaian->status == Penilaian::DI_TERIMA_PIMP)
                      {{-- // harus ada keputusan pimpinan & harus berstatus diterima --}}
                      <a onclick="window.print()" id="cetak_penilaian" class="btn btn-primary float-right">
                        Cetak<i class="fas fa-print ml-1"></i>
                      </a>
                    @endif
                  </div>
                </div>
              </div>
            </div>
            {{-- END --}}
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

    .timeline-avatar img,
    img.timeline-avatar {
      border-radius: 50%;
      display: inline;
      line-height: 1.8rem;
      position: absolute;
      top: 0;
      width: 1.8rem;
      left: 18px;
      outline: 2px solid #4a4e5357;
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
  <script src="{{ asset('js/back/daterangepicker.js') }}"></script>
  <script src="{{ asset('js/back/bs-stepper.min.js') }}"></script>

  {{-- flash merah --}}
  @if (session()->has('tolak'))
    <script>
      iziToast.error({
        title: 'Ok.',
        message: '{{ Session('tolak') }}',
        position: 'topCenter'
      });
    </script>
  @endif

  {{-- flash kuning --}}
  @if (session()->has('kuning'))
    <script>
      iziToast.warning({
        title: 'Ok.',
        message: '{{ Session('kuning') }}',
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

    //Initialize Select2 Elements
    $('.select2').select2()

    document.addEventListener('DOMContentLoaded', function() {
      const keputusanRadio = document.querySelectorAll('input[name="keputusan"]');
      const catatanTextarea = document.getElementById('catatan_pimpinan');
      const ttdCheckbox = document.getElementById('ttd_pimpinan');
      const submitButton = document.getElementById('beri_keputusan');

      function validateForm() {
        const isKeputusanSelected = Array.from(keputusanRadio).some(radio => radio.checked);
        const isCatatanFilled = catatanTextarea.value.trim() !== '';
        const isTtdChecked = ttdCheckbox.checked;

        // Aktifkan tombol jika semua persyaratan terpenuhi
        submitButton.disabled = !(isKeputusanSelected && isCatatanFilled && isTtdChecked);
      }

      // Event listener untuk semua input terkait
      keputusanRadio.forEach(radio => radio.addEventListener('change', validateForm));
      catatanTextarea.addEventListener('input', validateForm);
      ttdCheckbox.addEventListener('change', validateForm);
    });

    // jQuery.validator.addMethod("lettersonly", function(value, element) {
    //   return this.optional(element) || /^[a-zA-Z\s]+$/i.test(value);
    // }, "Input hanya berupa huruf.");

    jQuery.validator.addMethod("angka100", function(value, element) {
      // Pastikan nilai input adalah angka dan berada dalam rentang 1-100
      return this.optional(element) || (/^\d+$/.test(value) && parseInt(value, 10) >= 1 && parseInt(value, 10) <=
        100);
    }, "Input harus berupa angka dari 1 sampai 100");

    // Wait for the DOM to be ready
    $(function() {
      $("form[name='penilaian_update']").validate({
        // Specify validation rules
        rules: {
          catatan_atasan: {
            required: true,
            maxlength: 255,
            minlength: 3,
          },
          ttd_atasan: {
            required: true
          },
          ket_nilai_1: {
            maxlength: 128
          },
          ket_nilai_2: {
            maxlength: 128
          },
          ket_nilai_3: {
            maxlength: 128
          },
          ket_nilai_4: {
            maxlength: 128
          },
          ket_nilai_5: {
            maxlength: 128
          },
          ket_nilai_6: {
            maxlength: 128
          },
          ket_nilai_7: {
            maxlength: 128
          },
          ket_nilai_8: {
            maxlength: 128
          },
          ket_nilai_9: {
            maxlength: 128
          },
        },
        // Specify validation error messages

        messages: {
          catatan_atasan: {
            required: "Catatan harus ditulis",
            maxlength: "Maksimal {0} karakter",
            minlength: "Minimal {0} karakter",
          },
          ttd_atasan: {
            required: "Penilaian harus ditandatangani"
          },
          ket_nilai_1: {
            maxlength: "Maksimal {0} karakter"
          },
          ket_nilai_2: {
            maxlength: "Maksimal {0} karakter"
          },
          ket_nilai_3: {
            maxlength: "Maksimal {0} karakter"
          },
          ket_nilai_4: {
            maxlength: "Maksimal {0} karakter"
          },
          ket_nilai_5: {
            maxlength: "Maksimal {0} karakter"
          },
          ket_nilai_6: {
            maxlength: "Maksimal {0} karakter"
          },
          ket_nilai_7: {
            maxlength: "Maksimal {0} karakter"
          },
          ket_nilai_8: {
            maxlength: "Maksimal {0} karakter"
          },
          ket_nilai_9: {
            maxlength: "Maksimal {0} karakter"
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
          var actionType = $('#tombol-kirim').val();
          $('#tombol-kirim').html('Mengirim nilai..');

          // Menambahkan skrip untuk memperbarui nilai
          var currentTimestamp = new Date().toISOString();
          var updatedTimestamp = new Date(currentTimestamp);
          updatedTimestamp.setHours(updatedTimestamp.getHours() + 7);
          var formattedTimestamp = updatedTimestamp.toISOString().slice(0, 19).replace('T', ' ');

          $('#tgl_catatan_atasan').val(formattedTimestamp);
          $('#status').val('dinilai_atasan');

          console.log("valid >> " + form.isValid());
          form.submit();
        }
      });
    });
    // bagian script terhapus
  </script>
@endsection
