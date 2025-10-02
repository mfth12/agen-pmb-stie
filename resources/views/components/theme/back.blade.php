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

<body class="{{ $pushmenuState === 'collapsed' ? 'sidebar-collapse' : '' }}">
  <script src="https://cdn.jsdelivr.net/npm/@tabler/core@1.4.0/dist/js/tabler-theme.min.js" async defer></script>
  <div class="page">
    <x-back.navbar />
    @yield('container')
  </div>
  <x-modal.dasbor />
  <x-back.script />
  @yield('js_bawah')
</body>

</html>
