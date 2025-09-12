<!DOCTYPE html>
<html lang="id">

<head>
  <x-masuk.header :title="$title" />
  <x-back.pwa :konfigs="$konfigs" />
  <style>
    .disable-selection {
      -webkit-user-select: none;
      -moz-user-select: none;
      -ms-user-select: none;
      user-select: none;
    }

    .bakgron {
      position: relative;
      z-index: 0;
    }

    .bakgron::before {
      content: '';
      position: absolute;
      top: 0;
      right: 0;
      bottom: 0;
      left: 0;
      z-index: -1;
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
      background-attachment: fixed;
      background-image: url('{{ asset('img/background-stie.jpg') }}');
    }
  </style>
</head>

<body class="hold-transition login-page bakgron disable-selection">
  <div class="login-box" id="thisme">
    @yield('container')
  </div>
  <div id="pwaforwp-add-to-home-click" style="background-color:#d2dfeb"
    class="pwaforwp-footer-prompt pwaforwp-bounceInUp pwaforwp-animated">
    <span id="pwaforwp-prompt-close" class="pwaforwp-prompt-close"></span>
    <p>Pasang <strong>{{ session('konfigs')['nama_sistem'] . ' ' . session('konfigs')['unik'] }}</strong> di perangkat
      Anda</p>
    <div class="btn btn-sm btn-primary">Pasang</div>
  </div>
  <x-masuk.script />
</body>

</html>
