{{-- TAMBAHAN UNTUK PWA --}}
<div id="pwaforwp-add-to-home-click" style="background-color:#d2dfeb"
  class="pwaforwp-footer-prompt pwaforwp-bounceInUp pwaforwp-animated"><span id="pwaforwp-prompt-close"
    class="pwaforwp-prompt-close"></span>
  <p>Pasang <strong>{{ konfigs('NAMA_SISTEM') . ' ' . konfigs('NAMA_SISTEM_ALIAS') }}</strong> di perangkat Anda</p>
  <div class="btn btn-sm btn-primary">Pasang</div>
</div>
<script id="pwaforwp-download-js-js-extra">
  var pwaforwp_download_js_obj = {
    "force_rememberme": "0"
  };
</script>
{{-- TAMABAHAN JQUERY CDN --}}
<script src="https://code.jquery.com/jquery-3.7.1.min.js"
  integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
@vite(['resources/js/pwaforwp-video.js'])
@vite(['resources/js/pwaforwp-download.js'])
@vite(['resources/js/pwa-register-sw.js'])
@vite(['resources/assets/vendor/libs/@form-validation/popular.js'])
@vite(['resources/assets/vendor/libs/@form-validation/bootstrap5.js'])
@vite(['resources/assets/vendor/libs/@form-validation/auto-focus.js'])
{{-- TAMBAHAN HALAMAN MASUK JS --}}
@vite(['resources/js/pages/masuk.js'])
@vite(['resources/js/pages/konfig-tampilan.js'])
