<!DOCTYPE html>
<html lang="id">

<head>
  <x-front.header :title="$title" />
  <x-back.pwa />
  @vite(['resources/tabler-dist/js/tabler.min.js'])
</head>

<body>
  @vite(['resources/tabler-dist/js/tabler-theme.min.js'])
  <div class="login-box" id="thisme">
    @yield('container')
  </div>
  <x-front.script />
</body>

</html>
