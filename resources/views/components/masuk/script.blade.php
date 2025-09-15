@vite(['resources/js/back/jquery.min.js'])
@vite(['resources/js/part_js/additional.js'])
@vite(['resources/js/part_js/masuk.js'])

{{-- TAMBAHAN UNTUK PWA --}}
@vite(['resources/js/pwaforwp-video.js'])
<script id="pwaforwp-download-js-js-extra">
  var pwaforwp_download_js_obj = {
    "force_rememberme": "0"
  };
</script>
@vite(['resources/js/pwaforwp-download.js'])
@vite(['resources/js/pwa-register-sw.js'])

{{-- DISABLING RIGHT CLICK --}}
<script type="text/javascript">
  document.addEventListener('contextmenu', function(e) {
    e.preventDefault();
  });
</script>

{{-- DISABLING SHORTCUT KEY --}}
<script type="text/javascript">
  document.onkeydown = function(e) {
    if (e.keyCode == 123) {
      return false; // F12 key
    }
    if (e.ctrlKey && e.shiftKey && e.keyCode == 'I'.charCodeAt(0)) {
      return false; // Ctrl+Shift+I
    }
    if (e.ctrlKey && e.shiftKey && e.keyCode == 'J'.charCodeAt(0)) {
      return false; // Ctrl+Shift+J
    }
    if (e.ctrlKey && e.keyCode == 'U'.charCodeAt(0)) {
      return false; // Ctrl+U
    }
  }
</script>
