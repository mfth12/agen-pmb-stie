<!DOCTYPE html>
<html lang="id">

<head>
  <x-back.header :title="$title" />
  <x-back.pwa />
  @yield('style')
</head>

@php
  $pushmenuState = session('pushmenu_state', 'expanded'); // Default 'expanded' jika session kosong
@endphp

<body class="hold-transition sidebar-mini layout-fixed {{ $pushmenuState === 'collapsed' ? 'sidebar-collapse' : '' }}">
  <div class="wrapper" id="thisme">
    <x-back.navbar />
    <x-back.sidebar :konfigs="$konfigs" />
    <x-vendor.lara-izitoast.toast />
    @yield('container')
    <x-back.modal />
    <x-back.footer :konfigs="$konfigs" />
  </div>
  <x-back.script />
  <x-back.izitoast />
  @yield('js_bawah')
</body>

</html>
