{{-- META HTML --}}
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta http-equiv="X-UA-Compatible" content="ie=edge" />
<title>{{ $title }}</title>
{{-- BEGIN GLOBAL MANDATORY STYLES --}}
@vite(['resources/css/app.css']) {{-- this is tabler.css --}}
@vite(['resources/js/back/nprogress.js'])
{{-- ADD --}}
@vite(['resources/css/tabler-flags.css'])
@vite(['resources/css/tabler-flags.css'])
@vite(['resources/css/tabler-socials.css'])
@vite(['resources/css/tabler-payments.css'])
@vite(['resources/css/tabler-vendors.css'])
@vite(['resources/css/tabler-marketing.css'])
@vite(['resources/css/tabler-themes.css'])
{{-- FOR PWA --}}
<link rel="prefetch" href="{{ asset('manifest.json') }}">
<link rel="manifest" href="{{ asset('manifest.json') }}">
@vite(['resources/css/pwaforwp-main.css'])
{{-- FOR CLOUDFLARE TURNSTILE --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/icheck-bootstrap/3.0.1/icheck-bootstrap.min.css"
  integrity="sha512-8vq2g5nHE062j3xor4XxPeZiPjmRDh6wlufQlfC6pdQ/9urJkU07NM0tEREeymP++NczacJ/Q59ul+/K2eYvcg=="
  crossorigin="anonymous" referrerpolicy="no-referrer" />
{{-- FOR CUSTOM STYLES --}}
<style>
  @import url("https://rsms.me/inter/inter.css");
</style>
{{-- FOR CUSTOM JS ON BEGINING --}}
<script src="https://challenges.cloudflare.com/turnstile/v0/api.js" async defer></script>
{{-- END --}}
