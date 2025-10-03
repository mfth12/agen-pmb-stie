<!DOCTYPE html>
<html lang="id">

<head>
  <title>@yield('title')</title>
  <x-error.header />
</head>

<body class="disable-selection">
  <div class="hold-transition login-page">
    @yield('container')
    <a href="{{ url()->previous() }}" class="btn btn-primary mb-5">
      <i class="fas fa-chevron-left mr-1"></i>Kembali</a>
  </div>
</body>

</html>
