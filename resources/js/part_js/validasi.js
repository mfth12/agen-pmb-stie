jQuery.validator.addMethod("lettersonly", function (value, element) {
	return this.optional(element) || /^[a-zA-Z\s]+$/i.test(value);
	// return this.optional(element) || /^[a-z]+$/i.test(value); //tanpa spasi
	// var regex = new RegExp(/^[a-zA-Z\s]+$/);
}, "Input hanya berupa huruf.");

jQuery.validator.addMethod("angka", function (value, element) {
	return this.optional(element) || /^[0-9.]+$/i.test(value);
	// return this.optional(element) || /^[a-z]+$/i.test(value); //tanpa spasi
	// var regex = new RegExp(/^[a-zA-Z\s]+$/);
}, "Input hanya berupa kombinasi angka dan titik.");

// validation first form
// validation first form
// Wait for the DOM to be ready
$(function () {
	$("form[name='daftar_pengguna']").validate({
		// Specify validation rules
		rules: {
			nama: "required",
			nomer_induk: {
				required: true,
				angka: true,
				minlength: 6
			},
			email: {
				required: false,
				email: true // Specify that email should be validated by the built-in "email" rule
			},
			password: {
				required: true,
				minlength: 6
			},
			password_ulang: {
				required: true,
				minlength: 6,
				equalTo: "#password"
			},
			nisn: {
				minlength: 9
			},
			asal: {
				lettersonly: true
			},
			tempat_lahir: {
				lettersonly: true
			},

		},
		// Specify validation error messages
		messages: {
			nomer_induk: {
				required: "Nomor induk harus diisi.",
				angka: "ID hanya berupa kombinasi angka dan titik.",
				minlength: "*Nomor induk  minimal {0} karakter."
			},
			nama: "Nama lengkap harus diisi.",
			email: "Email harus berupa alamat yang valid.",
			password: {
				required: "Password harus diisi.",
				minlength: "Password minimal {0} karakter."
			},
			password_ulang: {
				required: "Konfirmasi password harus diisi.",
				equalTo: "Password konfirmasi tidak cocok.",
				minlength: "Password minimal {0} karakter."
			},
			nisn: {
				minlength: "NISN minimal {0} angka."
			},
			kelas: "Kelas harus dipilih.",


		},
		highlight: function (element) {

			$(element).closest('.input-group > input').addClass('is-invalid');
			$(element).closest('.form-group > input').addClass('is-invalid');
			$(element).closest('.form-group > select').addClass('is-invalid');

		},
		unhighlight: function (element) {

			$(element).closest('.input-group > input').removeClass('is-invalid');
			$(element).closest('.form-group > input').removeClass('is-invalid');
			$(element).closest('.form-group > select').removeClass('is-invalid');

		},
		errorElement: 'div',
		errorClass: 'invalid-feedback',
		errorPlacement: function (error, element) {
			if (element.parent('.input-group').length) {
				error.insertAfter(element.parent());
			} else {
				error.insertAfter(element);
			}
		},
		submitHandler: function (form) {
			console.log("valid >> " + form.isValid());
			form.submit();
		}
	});
});


// validation second form
// validation second form
// Wait for the DOM to be ready
$(function () {
	$("form[name='edit_pengguna']").validate({
		rules: {
			nama: "required",
			nomer_induk: {
				required: true,
				angka: true,
				minlength: 6
			},
			email: {
				required: false,
				email: true
			},
			password: {
				minlength: 6
			},
			nisn: {
				minlength: 9
			},
			asal: {
				lettersonly: true
			},
			tempat_lahir: {
				lettersonly: true
			},

		},
		// Specify validation error messages
		messages: {
			nomer_induk: {
				required: "Nomor induk harus diisi.",
				angka: "ID hanya berupa kombinasi angka dan titik.",
				minlength: "Nomor induk  minimal {0} karakter."
			},
			nama: "Nama lengkap harus diisi.",
			email: "Email harus berupa alamat yang valid.",
			password: {
				required: "Password harus diisi.",
				minlength: "Password minimal {0} karakter."
			},
			password_ulang: {
				required: "Konfirmasi password harus diisi.",
				equalTo: "Password konfirmasi tidak cocok.",
				minlength: "Password minimal {0} karakter."
			},
			nisn: {
				minlength: "NISN minimal {0} angka."
			},
			kelas: "Kelas harus dipilih.",

		},
		highlight: function (element) {

			$(element).closest('.input-group > input').addClass('is-invalid');
			$(element).closest('.form-group > input').addClass('is-invalid');
			$(element).closest('.form-group > select').addClass('is-invalid');

		},
		unhighlight: function (element) {

			$(element).closest('.input-group > input').removeClass('is-invalid');
			$(element).closest('.form-group > input').removeClass('is-invalid');
			$(element).closest('.form-group > select').removeClass('is-invalid');

		},
		errorElement: 'div',
		errorClass: 'invalid-feedback',
		errorPlacement: function (error, element) {
			if (element.parent('.input-group').length) {
				error.insertAfter(element.parent());
			} else {
				error.insertAfter(element);
			}
		},
		submitHandler: function (form) {
			console.log("valid >> " + form.isValid());
			form.submit();
		}
	});
});