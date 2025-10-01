{{-- META HTML --}}
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta http-equiv="X-UA-Compatible" content="ie=edge" />
<title>{{ $title }}</title>
{{-- GLOBAL MANDATORY STYLES --}}
@vite(['resources/tabler-dist/css/tabler.min.css'])
{{-- ADDITIONALS --}}
{{-- @vite(['resources/tabler-dist/css/tabler-flags.css'])
@vite(['resources/tabler-dist/css/tabler-flags.css'])
@vite(['resources/tabler-dist/css/tabler-socials.css'])
@vite(['resources/tabler-dist/css/tabler-payments.css'])
@vite(['resources/tabler-dist/css/tabler-vendors.css'])
@vite(['resources/tabler-dist/css/tabler-marketing.css'])
@vite(['resources/tabler-dist/css/tabler-themes.css']) --}}
<style>
  @import url("https://rsms.me/inter/inter.css");
  @import url("https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css");
  /* @import url("https://cdnjs.cloudflare.com/ajax/libs/icheck-bootstrap/3.0.1/icheck-bootstrap.min.css"); */
  @import url("https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css");
</style>
<script src="https://challenges.cloudflare.com/turnstile/v0/api.js" async defer></script>