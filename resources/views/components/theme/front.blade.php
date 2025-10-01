<!DOCTYPE html>
<html lang="id">

<head>
  <x-front.header :title="$title" />
  <x-back.pwa {{--  :konfigs="$konfigs" --}} />
</head>

<body>
  {{-- tabler-theme.js --}}
  @vite(['resources/js/tabler/tabler-theme.min.js'])
  <div class="login-box" id="thisme">
    @yield('container')
  </div>
  <x-front.script />
</body>

</html>
