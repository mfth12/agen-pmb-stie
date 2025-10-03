{{-- FAVICON --}}
{{-- <link rel="icon" type="image/x-icon" href="{{ asset('img/' . konfigs('LOGO')) }}"> --}}
<link rel="icon" type="image/png" href="{{ asset('logo-main.png') }}">
<link rel="apple-touch-icon" href="{{ asset('logo-main.png') }}">
<link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
{{-- FOR PWA --}}
<link rel="prefetch" href="{{ asset('manifest.json') }}">
<link rel="manifest" href="{{ asset('manifest.json') }}">