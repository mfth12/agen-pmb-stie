{{-- META HTML --}}
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta http-equiv="X-UA-Compatible" content="ie=edge" />
<title>{{ $title }}</title>
{{-- GLOBAL MANDATORY STYLES --}}
@vite(['resources/css/tabler/tabler.css']) {{-- this is tabler.css --}}
{{-- ADDITIONALS --}}
@vite(['resources/css/tabler/tabler-flags.css'])
@vite(['resources/css/tabler/tabler-flags.css'])
@vite(['resources/css/tabler/tabler-socials.css'])
@vite(['resources/css/tabler/tabler-payments.css'])
@vite(['resources/css/tabler/tabler-vendors.css'])
@vite(['resources/css/tabler/tabler-marketing.css'])
@vite(['resources/css/tabler/tabler-themes.css'])
{{-- @vite(['resources/assets/vendor/libs/@form-validation/form-validation.scss']) --}}
{{-- FOR PWA --}}
<link rel="prefetch" href="{{ asset('manifest.json') }}">
<link rel="manifest" href="{{ asset('manifest.json') }}">
@vite(['resources/css/pwaforwp-main.css'])
{{-- FOR CUSTOM STYLES --}}
<style>
  /* FOR CLOUDFLARE TURNSTILE */
  @import url("https://rsms.me/inter/inter.css");
  @import url("https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css");
  @import url("https://cdnjs.cloudflare.com/ajax/libs/icheck-bootstrap/3.0.1/icheck-bootstrap.min.css");
  @import url("https://cdn.jsdelivr.net/npm/@tabler/core@1.4.0/dist/css/tabler.min.css");
  @import url("https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css");
</style>
@vite(['resources/js/tabler/tabler.min.js'])
{{-- FOR CUSTOM JS ON BEGINING --}}
<script src="https://challenges.cloudflare.com/turnstile/v0/api.js" async defer></script>
<script src="https://cdn.jsdelivr.net/npm/@tabler/core@1.4.0/dist/js/tabler.min.js" crossorigin="anonymous" async defer>
</script>
{{-- END --}}
