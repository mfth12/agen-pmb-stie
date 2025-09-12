// untuk fadeout alert
$(document).ready(function () {
	window.setTimeout(function () {
		$(".alert-hilang").fadeTo(1200, 0).slideUp(750, function () {
			$(this).remove();
		});
	}, 3500); // alert menghilang dalam 3.5 detik
});

// untuk panggilan tooltip
$(function () {
	$('[data-toggle="tooltip"]').tooltip({ delay: { "show": 250, "hide": 175 } });
})

//input foto di form
function lihatGambar() {
	const gambar = document.querySelector('#foto');
	const gambarPreview = document.querySelector('.img-lihat')
	// const ganti = document.querySelector('#upload')

	gambarPreview.style.display = 'block';
	const oFReader = new FileReader();
	oFReader.readAsDataURL(gambar.files[0]);

	oFReader.onload = function (oFREvent) {
		gambarPreview.src = oFREvent.target.result;
	}
}

//input foto di form
function lihatLogo() {
	const logo = document.querySelector('#logo_lembaga');
	const logoPreview = document.querySelector('.logo-lihat')

	logoPreview.style.display = 'block';
	const oFReader = new FileReader();
	oFReader.readAsDataURL(logo.files[0]);

	oFReader.onload = function (oFREvent) {
		logoPreview.src = oFREvent.target.result;
	}
}

//input foto di form
function lihatIkon() {
	const ikon = document.querySelector('#ikon');
	const ikonPreview = document.querySelector('.ikon-lihat')

	ikonPreview.style.display = 'block';
	const oFReader = new FileReader();
	oFReader.readAsDataURL(ikon.files[0]);

	oFReader.onload = function (oFREvent) {
		ikonPreview.src = oFREvent.target.result;
	}
}

//keluar modal
function keluarConfirm(url) {
	$('#btn-keluar').attr('action', url);
	$('#konfirmasi-keluar').modal('show');
}

//tidak tersedia modal
function dev() {
	$('#tidakTersedia').modal('show');
}

// Konfigurasi NProgress
NProgress.configure({ showSpinner: true });
// Fungsi untuk memulai NProgress
function startLoading() {
	NProgress.start();
	NProgress.set(0.1); // To set a progress percentage, call .set(n), where n is a number between 0..1
}

// Fungsi untuk menghentikan NProgress setelah semua gambar dimuat
function stopLoadingWhenImagesLoaded($container) {
	const $images = $container.find('img');
	if ($images.length === 0) {
		NProgress.done();
		return;
	}
	let loadedCount = 0;
	function imageLoaded() {
		loadedCount++;
		if (loadedCount === $images.length) {
			NProgress.done();
		}
	}

	$images.each(function () {
		if (this.complete) {
			imageLoaded();
		} else {
			$(this).on('load', imageLoaded);
		}
	});
}

// Start NProgress saat AJAX request dimulai
$(document).ajaxStart(startLoading);

// End NProgress harus ada disetiap halaman yang ada tabel AJAXnya
// $(document).ajaxComplete(function(event, xhr, settings) {
// 	const $container = $('#tabel1, #tabel1'); // Gantilah dengan selector tabel Anda
// 	stopLoadingWhenImagesLoaded($container);
// });

// Javascript to enable link to tab
var url = document.location.toString();
if (url.match('#')) {
	$('.nav-item a[href="#' + url.split('#')[1] + '"]').tab('show');
}

