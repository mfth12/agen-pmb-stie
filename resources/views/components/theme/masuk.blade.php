<!DOCTYPE html>
<html lang="id">

<head>
  <x-masuk.header :title="$title" />
  <x-back.pwa :konfigs="$konfigs" />
</head>

<body class="hold-transition login-page bakgron disable-selection">
  @vite(['resources/js/tabler-theme.min.js']) {{-- this is tabler.css --}}

  <div class="login-box" id="thisme">
    @yield('container')
  </div>

  <x-masuk.script />
</body>

</html>
