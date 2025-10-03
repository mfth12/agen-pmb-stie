<!DOCTYPE html>
<html lang="id">

<head>
  <x-error.header />
  <title>@yield('title')</title>
</head>

<body class="border-top-wide border-primary">
  <script src="https://cdn.jsdelivr.net/npm/@tabler/core@1.4.0/dist/js/tabler-theme.min.js" async defer></script>

  <div class="page page-center">
    {{-- @yield('container') --}}
    <x-error.isi-error />

    {{-- <a href="{{ url()->previous() }}" class="btn btn-primary mb-5">
      <i class="fas fa-chevron-left mr-1"></i>Kembali</a> --}}
  </div>
  <x-error.script />
</body>

</html>
