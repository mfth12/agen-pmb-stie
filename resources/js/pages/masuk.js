'use strict';

document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('formAuthentication');
    const button = document.getElementById('loginButton');

    if (form) {
        const fv = FormValidation.formValidation(form, {
            fields: {
                username: {
                    validators: {
                        notEmpty: {
                            message: 'Silakan isi username Anda'
                        },
                        stringLength: {
                            min: 6,
                            message: 'Username minimal 6 karakter'
                        }
                    }
                },
                password: {
                    validators: {
                        notEmpty: {
                            message: 'Silakan isi password Anda'
                        },
                        stringLength: {
                            min: 6,
                            message: 'Password minimal 6 karakter'
                        }
                    }
                }
            },
            plugins: {
                trigger: new FormValidation.plugins.Trigger(),
                bootstrap5: new FormValidation.plugins.Bootstrap5({
                    rowSelector: function (field, ele) {
                        // username pakai .mb-3, password pakai .mb-2
                        return field === 'username' ? '.mb-3' : '.mb-2';
                    },
                    eleInvalidClass: 'is-invalid',
                    eleValidClass: 'is-valid'
                }),
                submitButton: new FormValidation.plugins.SubmitButton(),
                autoFocus: new FormValidation.plugins.AutoFocus()
            },
        });

        // === HANDLER TOMBOL LOGIN ===
        button.addEventListener('click', function (e) {
            e.preventDefault();

            const loader = button.querySelector('.spinner-border');
            fv.validate().then(function (status) {
                if (status === 'Valid') {
                    button.querySelector('.button-text').textContent = 'Memproses';
                    loader.classList.remove('d-none');
                    button.disabled = true;

                    form.submit(); // submit normal
                }
            });
        });
    }

    // === HILANGKAN ALERT OTOMATIS ===
    setTimeout(function () {
        document.querySelectorAll('.alert-hilang').forEach(function (alert) {
            alert.style.transition = "opacity 1.2s, transform 0.75s";
            alert.style.opacity = "0";
            setTimeout(() => alert.remove(), 2000);
        });
    }, 5500);

    // === TOGGLE PASSWORD ===
    document.getElementById('toggle-password').addEventListener('click', function () {
        const $password = document.getElementById('password');
        const $icon = document.getElementById('toggle-password-icon');
        if ($password.type === 'password') {
            $password.type = 'text';
            $icon.classList.remove('ti-eye-off');
            $icon.classList.add('ti-eye');
        } else {
            $password.type = 'password';
            $icon.classList.remove('ti-eye');
            $icon.classList.add('ti-eye-off');
        }
    });

    // === DISABLE RIGHT CLICK + DEV TOOLS ===
    document.addEventListener('contextmenu', e => e.preventDefault());
    document.onkeydown = function (e) {
        if (e.keyCode === 123) return false;
        if (e.ctrlKey && e.shiftKey && e.keyCode === 'I'.charCodeAt(0)) return false;
        if (e.ctrlKey && e.shiftKey && e.keyCode === 'J'.charCodeAt(0)) return false;
        if (e.ctrlKey && e.keyCode === 'U'.charCodeAt(0)) return false;
    };
});
