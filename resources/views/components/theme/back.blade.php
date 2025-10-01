<!DOCTYPE html>
<html lang="id">

<head>
  <x-back.header :title="$title" />
  <x-back.pwa />
  @yield('style')
  @vite(['resources/tabler-dist/js/tabler.min.js'])
</head>

@php
  $pushmenuState = session('pushmenu_state', 'expanded'); // Default 'expanded' jika session kosong
@endphp

<body class="{{ $pushmenuState === 'collapsed' ? 'sidebar-collapse' : '' }}">
  <div class="page">
    <x-back.navbar />
    @yield('container')
  </div>
  <x-back.page-modal {{-- :konfigs="$konfigs" --}} />
  @vite(['resources/js/pages/konfig-tampilan.js'])
  {{-- <x-back.modal /> --}}
  {{-- <x-back.footer :konfigs="$konfigs" /> --}}
  <x-back.script />
  @vite(['resources/js/pages/dasbor.js'])
  @yield('js_bawah')
</body>

</html>
