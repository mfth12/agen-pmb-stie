{{-- META HTML --}}
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta http-equiv="X-UA-Compatible" content="ie=edge" />
<title>{{ $title }}</title>
<script src="https://cdn.jsdelivr.net/npm/@tabler/core@1.4.0/dist/libs/apexcharts/dist/apexcharts.min.js"></script>

<style>
  /* GLOBAL MANDATORY STYLES */
  @import url("https://cdn.jsdelivr.net/npm/@tabler/core@1.4.0/dist/css/tabler.min.css");
  @import url("https://cdn.jsdelivr.net/npm/@tabler/core@1.4.0/dist/css/tabler-flags.css");
  @import url("https://cdn.jsdelivr.net/npm/@tabler/core@1.4.0/dist/css/tabler-socials.css");
  @import url("https://cdn.jsdelivr.net/npm/@tabler/core@1.4.0/dist/css/tabler-payments.css");
  @import url("https://cdn.jsdelivr.net/npm/@tabler/core@1.4.0/dist/css/tabler-vendors.css");
  @import url("https://cdn.jsdelivr.net/npm/@tabler/core@1.4.0/dist/css/tabler-marketing.css");
  @import url("https://cdn.jsdelivr.net/npm/@tabler/core@1.4.0/dist/css/tabler-themes.css");

  /* ADDITIONALS */
  @import url("https://rsms.me/inter/inter.css");
  @import url("https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css");
  @import url("https://cdn.jsdelivr.net/npm/@tabler/core@1.4.0/dist/libs/jsvectormap/dist/jsvectormap.min.css");
  @import url("https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css");
</style>

<script src="https://challenges.cloudflare.com/turnstile/v0/api.js" async defer></script>
<script src="https://cdn.jsdelivr.net/npm/@tabler/core@1.4.0/dist/js/tabler.min.js" async defer></script>
