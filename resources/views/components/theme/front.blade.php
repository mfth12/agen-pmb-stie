<!DOCTYPE html>
<html lang="id">

<head>
  <x-front.header :title="$title" />
  <x-back.pwa />
  @yield('style')
</head>

<body>
  <script src="https://cdn.jsdelivr.net/npm/@tabler/core@1.4.0/dist/js/tabler-theme.min.js" async defer></script>
  @yield('container')
  <x-front.script />
</body>

</html>
