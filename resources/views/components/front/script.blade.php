{{-- jQuery CDN --}}
<script src="https://code.jquery.com/jquery-3.7.1.min.js"
  integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

<div id="pwaforwp-add-to-home-click" style="background-color:#d2dfeb"
  class="pwaforwp-footer-prompt pwaforwp-bounceInUp pwaforwp-animated">
  <span id="pwaforwp-prompt-close" class="pwaforwp-prompt-close"></span>
  <p>
    Pasang
    <strong>{{ konfigs('NAMA_SISTEM') . ' ' . konfigs('NAMA_SISTEM_ALIAS') }}</strong>
    di perangkat Anda
  </p>
  <div class="btn btn-sm btn-primary">Pasang</div>
</div>

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

  // untuk fadeout alert
  $(document).ready(function() {
    window.setTimeout(function() {
      $(".alert-hilang").fadeTo(1200, 0).slideUp(750, function() {
        $(this).remove();
      });
    }, 3500); // alert menghilang dalam 3.5 detik
  });

  // toggle password
  $(document).ready(function() {
    $('#toggle-password').on('click', function() {
      let $password = $('#password');
      let $icon = $('#toggle-password-icon');

      if ($password.attr('type') === 'password') {
        $password.attr('type', 'text');
        $icon.removeClass('ti-eye-off').addClass('ti-eye');
      } else {
        $password.attr('type', 'password');
        $icon.removeClass('ti-eye').addClass('ti-eye-off');
      }
    });
  });
</script>
