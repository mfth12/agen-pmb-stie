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
  <x-modal.dasbor {{-- :konfigs="$konfigs" --}} />
  @vite(['resources/js/pages/konfig-tampilan.js'])
  {{-- <x-back.modal /> --}}
  {{-- <x-back.footer :konfigs="$konfigs" /> --}}
  <x-back.script />
  @yield('js_bawah')
</body>

</html>
