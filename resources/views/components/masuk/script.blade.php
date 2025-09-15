{{-- <script src="{{ asset('js/back/jquery.min.js') }}"></script> --}}
{{-- <script src="{{ asset('js/back/bootstrap.bundle.min.js') }}"></script> --}}
{{-- <script src="{{ asset('js/back/adminlte.min.js') }}"></script> --}}
{{-- <script src="{{ asset('') }}"></script> --}}
{{-- <script src="{{ asset('') }}"></script> --}}
{{-- ADD --}}
@vite(['resources/js/back/jquery.min.js'])
@vite(['resources/js/part_js/additional.js'])
@vite(['resources/js/part_js/masuk.js'])

{{-- tambahan untuk pwa --}}
@vite(['resources/js/pwaforwp-video.js'])
{{-- accepted --}}
{{-- <script src="{{ asset('?ver=1.7.69.8') }}" id="pwaforwp-video-js-js"></script> --}}
<script id="pwaforwp-download-js-js-extra">
  var pwaforwp_download_js_obj = {
    "force_rememberme": "0"
  };
</script>
{{-- <script src="{{ asset('js/pwaforwp-download.js?ver=1.7.69.8') }}" id="pwaforwp-download-js-js"></script> --}}
{{-- <script src="{{ asset('js/pwa-register-sw.js?ver=1.7.69') }}" id="pwa-main-script-js"></script> --}}
@vite(['resources/js/pwaforwp-download.js'])
@vite(['resources/js/pwa-register-sw.js'])


{{-- for disabled right click --}}
<script type="text/javascript">
  document.addEventListener('contextmenu', function(e) {
    e.preventDefault();
  });
</script>
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
