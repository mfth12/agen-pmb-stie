<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="pwaforwp" content="system-plugin" />
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>{{ $title }}</title>
{{-- Google Font: Source Sans Pro --}}
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
{{-- Font Awesome Icons --}}
<link rel="stylesheet" href="{{ asset('css/font-awesome3all.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/icheck-bootstrap/3.0.1/icheck-bootstrap.min.css"
  integrity="sha512-8vq2g5nHE062j3xor4XxPeZiPjmRDh6wlufQlfC6pdQ/9urJkU07NM0tEREeymP++NczacJ/Q59ul+/K2eYvcg=="
  crossorigin="anonymous" referrerpolicy="no-referrer" />
{{-- AdminLTE3 --}}
{{-- <link rel="stylesheet" href="{{ asset('css/back/adminlte.min.css') }}"> --}}
@vite(['resources/css/back/adminlte-lama.min.css'])

{{-- Loading progress --}}
<script src="{{ asset('js/back/nprogress.js') }}"></script>
{{-- For PWA --}}
<link rel="prefetch" href="{{ asset('manifest.json') }}">
<link rel="manifest" href="{{ asset('manifest.json') }}">
<link rel="stylesheet" id='pwaforwp-style-css' href="{{ asset('css/pwaforwp-main.css') }}" media="all">
{{-- For cloudflare --}}
<script src="https://challenges.cloudflare.com/turnstile/v0/api.js" async defer></script>
