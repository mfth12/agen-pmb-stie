{{-- META HTML --}}
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta http-equiv="X-UA-Compatible" content="ie=edge" />
<title>{{ $title }}</title>
{{-- GLOBAL MANDATORY STYLES --}}
@vite(['resources/css/app.css']) {{-- this is tabler.css --}}
{{-- ADDITIONALS --}}
@vite(['resources/css/tabler-flags.css'])
@vite(['resources/css/tabler-flags.css'])
@vite(['resources/css/tabler-socials.css'])
@vite(['resources/css/tabler-payments.css'])
@vite(['resources/css/tabler-vendors.css'])
@vite(['resources/css/tabler-marketing.css'])
@vite(['resources/css/tabler-themes.css'])
@vite(['resources/assets/vendor/libs/@form-validation/form-validation.scss'])
{{-- FOR PWA --}}
<link rel="prefetch" href="{{ asset('manifest.json') }}">
<link rel="manifest" href="{{ asset('manifest.json') }}">
@vite(['resources/css/pwaforwp-main.css'])
{{-- FOR CUSTOM STYLES --}}
<style>
  /* FOR CLOUDFLARE TURNSTILE */
  @import url("https://cdnjs.cloudflare.com/ajax/libs/icheck-bootstrap/3.0.1/icheck-bootstrap.min.css");
  @import url("https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css");
  @import url("https://rsms.me/inter/inter.css");
  /* @import url("https://cdn.jsdelivr.net/npm/formvalidation@0.6.2-dev/dist/css/formValidation.min.css"); */
</style>
@vite(['resources/js/tabler.min.js'])
@vite(['resources/js/back/nprogress.js'])
{{-- FOR CUSTOM JS ON BEGINING --}}
<script src="https://challenges.cloudflare.com/turnstile/v0/api.js" async defer></script>
{{-- <script src="https://cdn.jsdelivr.net/npm/formvalidation@0.6.2-dev/dist/js/formValidation.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script> --}}


{{-- END --}}
