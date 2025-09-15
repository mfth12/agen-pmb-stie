<!DOCTYPE html>
<html lang="id">

<head>
  <x-masuk.header :title="$title" />
  <x-back.pwa :konfigs="$konfigs" />
</head>

<body class="hold-transition login-page bakgron disable-selection">
  <div class="login-box" id="thisme">
    @yield('container')
  </div>
  <div id="pwaforwp-add-to-home-click" style="background-color:#d2dfeb"
    class="pwaforwp-footer-prompt pwaforwp-bounceInUp pwaforwp-animated">
    <span id="pwaforwp-prompt-close" class="pwaforwp-prompt-close"></span>
    <p>Pasang <strong>{{ konfigs('NAMA_SISTEM') . ' ' . konfigs('UNIK') }}</strong> di perangkat Anda</p>
    <div class="btn btn-sm btn-primary">Pasang</div>
  </div>
  <x-masuk.script />
</body>

</html>
