<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>{{ $title }}</title>
{{-- Google Font: Source Sans Pro --}}
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
{{-- Font Awesome Icons --}}
{{-- <script src="https://kit.fontawesome.com/c19cab79ac.js" crossorigin="anonymous"></script> --}}
<link rel="stylesheet" href="{{ asset('css/font-awesome3all.css') }}">
{{-- <script src="/js/back/font-awesome.js"></script> --}}
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
{{-- JS-atas --}}
@yield('js_atas')
{{-- iziToast --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/css/iziToast.css"
  integrity="sha256-pODNVtK3uOhL8FUNWWvFQK0QoQoV3YA9wGGng6mbZ0E=" crossorigin="anonymous" />
{{-- icheck bootstrap --}}
<link rel="stylesheet" href="{{ asset('css/back/icheck-bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/tables/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/tables/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/tables/buttons.bootstrap4.min.css') }}">
{{-- Theme style --}}
{{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" crossorigin="anonymous"> --}}
<link rel="stylesheet" href="{{ asset('css/back/OverlayScrollbars.min.css') }}">
{{-- <link rel="stylesheet" href="{{ asset('css/back/adminlte.min.css') }}"> --}}
<link rel="stylesheet" href="{{ asset('css/back/adminlte-lama.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/back/dropify.min.css') }}">
<script src="{{ asset('js/back/nprogress.js') }}"></script>
<link rel="stylesheet" href="{{ asset('css/back/nprogress.css') }}">
