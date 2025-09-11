{{-- jQuery --}}
<script src="{{ asset('js/back/jquery.min.js') }}"></script>
<script src="{{ asset('js/part_js/jquery.validate.min.js') }}"></script>{{-- jQuery validator --}}
{{-- Bootstrap 4 --}}
<script src="{{ asset('js/back/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('js/tables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('js/tables/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('js/tables/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('js/tables/dataTables.buttons.min.js') }}"></script>
{{-- <script src="/js/tables/buttons.bootstrap4.min.js"></script>
<script src="/js/tables/buttons.html5.min.js"></script>
<script src="/js/tables/buttons.print.min.js"></script>
<script src="/js/tables/buttons.colVis.min.js"></script> --}}
<script src="{{ asset('js/process/jszip.min.js') }}"></script>
{{-- <script src="/js/process/pdfmake.min.js"></script> --}}
{{-- <script src="/js/process/vfs_fonts.js"></script> --}}
<script src="{{ asset('js/demo.js') }}"></script>
<script src="{{ asset('js/iziToast.js') }}"></script> {{-- iziToast --}}
{{-- @include('vendor.lara-izitoast.toast') --}}
{{-- Batas --}}
{{-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.0/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.39.0/js/tempusdominus-bootstrap-4.min.js">
</script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.39.0/css/tempusdominus-bootstrap-4.min.css" /> --}}



{{-- untuk konfigurasi tabel --}}
{{-- @if ($tabel == 'penggunaasd') --}}
{{-- <script src="/js/part_js/tabel_pengguna.js"></script> --}}
{{-- <script src="/js/part_js/tabel_default.js"></script> --}}
{{-- @endif --}}

{{-- javascript untuk admin lte 3 --}}
<script src="{{ asset('js/back/jquery.overlayScrollbars.min.js') }}"></script>
<script src="{{ asset('js/back/adminlte.min.js') }}"></script>

{{-- tambah popper.js --}}
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
  integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
{{-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script> --}}
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7. 29.2/sweetalert2.all.js"></script> --}}
<script src="{{ asset('js/back/dropify.min.js') }}"></script>
{{-- <script src="{{ asset('') }}js/back/helpers.js"></script> --}}
<script src="{{ asset('js/part_js/additional.js') }}"></script>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    // Cek apakah layar cukup besar untuk dianggap desktop (misalnya min-width: 768px)
    if (window.innerWidth < 991) {
      return; // Jangan jalankan script jika layar lebih kecil dari 768px (mobile)
    }

    const body = document.body;
    const pushMenuButton = document.getElementById('menu_klik');
    if (pushMenuButton) {
      // Event listener khusus untuk menyimpan state
      pushMenuButton.addEventListener('click', function() {
        // Tunggu sampai AdminLTE mengubah kelasnya
        setTimeout(() => {
          const isCollapsed = body.classList.contains('sidebar-collapse');

          // Kirim state baru ke server
          fetch('/pushmenu-state', {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json',
              'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({
              state: isCollapsed ? 'collapsed' : 'expanded'
            })
          });
        }, 20);
      });
    }
  });

  // document.addEventListener('DOMContentLoaded', function() {
  //   const fullscreenButton = document.querySelector('[data-widget="fullscreen"]');
  //   const body = document.body;

  //   // Periksa state fullscreen di localStorage saat halaman dimuat
  //   if (localStorage.getItem('isFullscreen') === 'true') {
  //     enableFullscreen();
  //   }

  //   // Event handler untuk tombol fullscreen
  //   if (fullscreenButton) {
  //     fullscreenButton.addEventListener('click', function() {
  //       const isFullscreen = localStorage.getItem('isFullscreen') === 'true';

  //       if (isFullscreen) {
  //         disableFullscreen();
  //       } else {
  //         enableFullscreen();
  //       }
  //     });
  //   }

  //   // Fungsi untuk mengaktifkan fullscreen
  //   function enableFullscreen() {
  //     if (body.requestFullscreen) {
  //       body.requestFullscreen();
  //     } else if (body.webkitRequestFullscreen) { // Safari
  //       body.webkitRequestFullscreen();
  //     } else if (body.msRequestFullscreen) { // IE11
  //       body.msRequestFullscreen();
  //     }
  //     localStorage.setItem('isFullscreen', 'true');
  //   }

  //   // Fungsi untuk menonaktifkan fullscreen
  //   function disableFullscreen() {
  //     if (document.exitFullscreen) {
  //       document.exitFullscreen();
  //     } else if (document.webkitExitFullscreen) { // Safari
  //       document.webkitExitFullscreen();
  //     } else if (document.msExitFullscreen) { // IE11
  //       document.msExitFullscreen();
  //     }
  //     localStorage.setItem('isFullscreen', 'false');
  //   }
  // });
</script>
