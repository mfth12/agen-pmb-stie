  {{-- flash hijau --}}
  @if (session()->has('hijau'))
    <script>
      iziToast.success({
        title: 'Berhasil.',
        message: '{{ Session('hijau') }}',
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

  {{-- flash merah --}}
  @if (session()->has('merah'))
    <script>
      iziToast.error({
        title: 'Gagal.',
        message: '{{ Session('merah') }}',
        position: 'topCenter'
      });
    </script>
  @endif

  {{-- flash merah (Error) --}}
  @if ($errors->has('merah'))
    <script>
      iziToast.error({
        title: 'Gagal.',
        message: '{{ $errors->first('merah') }}',
        position: 'topCenter'
      });
    </script>
  @endif

  {{-- flash info selamat datang --}}
  @if (session()->has('info'))
    <script>
      iziToast.info({
        title: 'Selamat Datang',
        message: '{{ Session('info') }}',
        position: 'topCenter'
      });
    </script>
  @endif

  {{-- flash info biasa --}}
  @if (session()->has('info_biasa'))
    <script>
      setTimeout(function() {
        iziToast.info({
          message: '{{ Session('info_biasa') }}',
          position: 'topCenter'
        });
      }, 750); // 750 ms = 0.75 detik
    </script>
  @endif
