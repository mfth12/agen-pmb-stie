/**
 * Halaman otentikasi masuk
 */
'use strict';

// Deklarasi variabel global untuk FormValidation instance
let fv;
const formAuthentication = document.querySelector('#formAuthentication');

document.addEventListener('DOMContentLoaded', function (e) {
    (function () {
        // Form validation untuk login
        if (formAuthentication) {
            fv = FormValidation.formValidation(formAuthentication, {
                // Set the default locale
                fields: {
                    username: {
                        validators: {
                            notEmpty: {
                                message: 'Silakan isi username'
                            },
                            stringLength: {
                                min: 6,
                                message: 'Username harus lebih dari 6 karakter'
                            }
                        }
                    },
                    password: {
                        validators: {
                            notEmpty: {
                                message: 'Silakan isi password'
                            },
                            stringLength: {
                                min: 6,
                                message: 'Password harus lebih dari 6 karakter'
                            }
                        }
                    }
                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    bootstrap5: new FormValidation.plugins.Bootstrap5({
                        eleValidClass: '',
                        rowSelector: '.mb-2'
                    }),
                    submitButton: new FormValidation.plugins.SubmitButton(),
                    // defaultSubmit: new FormValidation.plugins.DefaultSubmit(), //tidak menggunakan ini
                    autoFocus: new FormValidation.plugins.AutoFocus()
                },
                init: instance => {
                    instance.on('plugins.message.placed', function (e) {
                        if (e.element.parentElement.classList.contains('input-group')) {
                            e.element.parentElement.insertAdjacentElement('afterend', e.messageElement);
                        }
                    });
                }
            });
        }
        // end validation
    })();
});

// FUNGSI UNTUK MENGHILANGKAN ALERT OTOMATOS
$(document).ready(function () {
    window.setTimeout(function () {
        $('.alert-hilang')
            .fadeTo(1200, 0)
            .slideUp(750, function () {
                $(this).remove();
            });
    }, 7500);
});

// HANDLER UNTUK TOMBOL LOGIN
$(document).ready(function () {
    $('#loginButton').on('click', function (e) {
        e.preventDefault(); // Mencegah submit langsung
        const button = $(this);
        const loader = button.find('.spinner-border');
        const form = button.closest('form');
        const btnText = button.find('.button-text');

        // Validasi form menggunakan instance yang sudah ada
        fv.validate()
            .then(function (status) {
                if (status === 'Valid') {
                    // Langsung ganti teks + efek fadeIn
                    btnText.text('Memproses').hide().fadeIn(200);

                    // Tampilkan loader
                    loader.removeClass('d-none');
                    button.prop('disabled', true);

                    // Submit form setelah 500ms agar animasi loading terlihat
                    setTimeout(() => {
                        form.submit();
                    }, 500);
                }
            })
            .catch(function (err) {
                console.error('Validasi error:', err);
            });
    });
});


// ANIMASI HITUNGAN MUNDUR UNTUK THROTLE
document.addEventListener('DOMContentLoaded', function () {
    const countdown = document.getElementById('countdown');
    if (countdown) {
        let seconds = parseInt(countdown.innerText);
        const interval = setInterval(() => {
            seconds--;
            if (seconds <= 0) {
                countdown.innerText = '0';
                clearInterval(interval);
            } else {
                countdown.innerText = seconds;
            }
        }, 1000);
    }
});


// DISABLING RIGHT CLICK
document.addEventListener('contextmenu', function (e) {
    e.preventDefault();
});

// DISABLING SHORTCUT KEY
document.onkeydown = function (e) {
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

// FUNGSI UNTUK AUTO NGIKUTIN TEMA TAMPILAN (DARK/LIGHT)
document.addEventListener("DOMContentLoaded", function () {
    // Ambil value dari localStorage
    let theme = localStorage.getItem("tabler-theme") || "light";
    console.log("this is =", theme);

    // Terapkan tema ke elemen target
    const widget = document.getElementById("cf-turnstile-widget");
    if (widget) {
        widget.setAttribute("data-theme", theme);
    }

    // Terapkan juga ke login-illustration
    const illustration = document.getElementById("login-illustration");
    if (illustration && window.assetBase) {
        illustration.src =
            theme === "dark"
                ? window.assetBase + "/login-illustration-dark.png"
                : window.assetBase + "/login-illustration.png";
    }
});