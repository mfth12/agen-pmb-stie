<!DOCTYPE html>
<html lang="id">

<head>
  <title>@yield('title')</title>
  <x-error.header />
  <style>
    .disable-selection {
      -webkit-user-select: none;
      -moz-user-select: none;
      -ms-user-select: none;
      user-select: none;
    }
  </style>
</head>

<body class="disable-selection">
  <div class="hold-transition login-page">
    @yield('container')
    {{-- <a href="{{ url()->previous() }}" class="btn btn-primary mb-5">
      <i class="fas fa-rotate-right mr-1"></i>Muat Ulang</a> --}}
    <button id="reloadButton" class="btn btn-primary mb-5" onclick="goBack()"></button>
  </div>
  <script>
    // Fungsi untuk kembali ke halaman sebelumnya
    function goBack() {
      window.history.back();
    }

    // Countdown timer untuk kembali ke halaman sebelumnya secara otomatis setiap 10 detik
    var countdown = 10;
    function updateCountdown() {
      document.getElementById('reloadButton').innerHTML =
        // `<i class="fa-solid fa-circle fa-beat-fade fa-xs mr-2"></i>Muat Ulang (${countdown})`;
        `Muat Ulang (${countdown})`;
      countdown--;

      if (countdown < 0) {
        goBack(); // Kembali ke halaman sebelumnya setelah countdown mencapai 0
      } else {
        setTimeout(updateCountdown, 1000); // Memanggil fungsi updateCountdown setiap detik
      }
    }

    // Memanggil fungsi updateCountdown saat halaman dimuat
    document.addEventListener('DOMContentLoaded', function() {
      updateCountdown();
    });
  </script>
</body>

</html>
