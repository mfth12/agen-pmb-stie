<!DOCTYPE html>
<html lang="id">

<head>
  <x-front.header :title="$title" />
  <x-back.pwa {{--  :konfigs="$konfigs" --}} />
</head>

<body>
  @vite(['resources/js/tabler/tabler-theme.min.js']) {{-- this is tabler.css --}}
  <div class="login-box" id="thisme">
    @yield('container')
  </div>
  <x-front.script />
</body>

</html>
