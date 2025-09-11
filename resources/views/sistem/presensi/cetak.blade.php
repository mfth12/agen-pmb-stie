<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  @php
    $startDate = \Carbon\Carbon::parse($mulaiDate);
    $endDate = \Carbon\Carbon::parse($endDate);
    $singleDateShow = $startDate->translatedFormat('d M Y');
    $doubleDateShow = $startDate->translatedFormat('d M Y') . ' sd. ' . $endDate->translatedFormat('d M Y');
  @endphp

  <title>Cetak Presensi{{ $startDate->isSameDay($endDate) ? $singleDateShow : $doubleDateShow }}</title>
  <link rel="stylesheet" href="{{ asset('css/font-awesome3all.css') }}">
  {{-- <link rel="stylesheet" href="{{ asset('css/tables/dataTables.bootstrap4.min.css') }}"> --}}
  {{-- <link rel="stylesheet" href="{{ asset('css/tables/responsive.bootstrap4.min.css') }}"> --}}
  <link rel="stylesheet" href="{{ asset('css/back/adminlte-lama.min.css') }}">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/qrious/4.0.2/qrious.min.js"></script>
  <style>
    /* body {
      margin: 10px;
    } */
  </style>
</head>

<body>
  <div class="container-fluid">
    <table style="width: 100%;">
      <tr>
        <td class="mt-2" style="text-align: center; vertical-align: middle; width: 85px;">
          <p></p>
          <img src="{{ asset('img/' . $konfigs->logo_lembaga) }}" alt="Logo" style="width: 75px; height: auto;">
        </td>
        <td style="vertical-align: middle;">
          <h2 class="mt-4">Presensi Pegawai</h2>
          <h5>Periode: {{ $startDate->isSameDay($endDate) ? $singleDateShow : $doubleDateShow }}</h5>
        </td>
      </tr>
    </table>
    <table class="table table-bordered table-valign-middle table-sm mt-4">
      <thead class="thead-light">
        <tr>
          <th style="width: 1%" class="text-center">No</th>
          <th style="width: 25%">Nama</th>
          <th class="text-center">Hari/Tanggal</th>
          <th class="text-center" colspan="2">Masuk</th>
          <th class="text-center" colspan="2">Pulang</th>
          <th class="text-center">Ket.</th>
        </tr>
      </thead>
      <tbody>
        @php
          $groupedPresensi = [];
          foreach ($list_presensi as $data) {
              $key = $data->pengguna->nama . '|' . \Carbon\Carbon::parse($data->tanggalPresensi)->format('Y-m-d');
              if (!isset($groupedPresensi[$key])) {
                  $groupedPresensi[$key] = [
                      'nama' => $data->pengguna->nama,
                      'tanggal' => \Carbon\Carbon::parse($data->tanggalPresensi)->translatedFormat('l, j M Y'),
                      'waktu_masuk' => null,
                      'status_masuk' => null,
                      'waktu_pulang' => null,
                      'status_pulang' => null,
                  ];
              }

              if ($data->status === 'masuk') {
                  $groupedPresensi[$key]['waktu_masuk'] = \Carbon\Carbon::parse($data->waktuPresensi)->format('H:i:s');
                  $groupedPresensi[$key]['status_masuk'] = 'Masuk';
              } elseif ($data->status === 'pulang') {
                  $groupedPresensi[$key]['waktu_pulang'] = \Carbon\Carbon::parse($data->waktuPresensi)->format('H:i:s');
                  $groupedPresensi[$key]['status_pulang'] = 'Pulang';
              }
          }
        @endphp

        @if (count($groupedPresensi) === 0)
          <tr>
            <td colspan="8" class="text-center">Tidak ada rekam data presensi</td>
          </tr>
        @else
          @foreach ($groupedPresensi as $index => $data)
            <tr>
              <td class="text-center">{{ $loop->iteration }}</td>
              <td class="text-left">{{ \Illuminate\Support\Str::limit($data['nama'], 30) }}</td>
              <td class="text-center">{{ $data['tanggal'] }}</td>
              <td class="text-center">{{ $data['waktu_masuk'] }}</td>
              <td class="text-center">{{ $data['status_masuk'] }}</td>
              <td class="text-center">{{ $data['waktu_pulang'] }}</td>
              <td class="text-center">{{ $data['status_pulang'] }}</td>
              <td class="text-center"><i class="fas fa-check" style="color: green"></i></td>
            </tr>
          @endforeach
        @endif
      </tbody>
    </table>
    <div style="margin-top: 30px; text-align: right;">
      <p style="margin-block-end: 5px;">Dokumen ini digenerate oleh sistem</p>
      <canvas id="qr-code"></canvas>
    </div>
  </div>

  <script>
    // Panggil dialog cetak saat halaman dimuat
    window.onload = function() {
      var isPrinting = false;
      window.print();

      // // Deteksi jika dialog cetak dibatalkan
      // setTimeout(function() {
      //   if (!isPrinting) {
      //     window.close();
      //   }
      // }, 100); // Waktu tunda untuk memastikan dialog cetak terbuka

      // // Listener untuk menutup tab setelah dialog selesai
      // window.onafterprint = function() {
      //   isPrinting = true; // Tandai dialog telah selesai
      //   window.close(); // Tutup tab setelah dialog selesai
      // };

      // Generate QR Code
      var qr = new QRious({
        element: document.getElementById('qr-code'),
        value: window.location.href, // URL halaman saat ini
        size: 128 // Ukuran QR Code
      });
    };
  </script>
</body>

</html>
