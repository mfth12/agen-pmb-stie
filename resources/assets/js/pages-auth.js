/**
 *  Pages Authentication
 */

'use strict';

// Deklarasi variabel global untuk FormValidation instance
let fv;
const formAuthentication = document.querySelector('#formAuthentication');

document.addEventListener('DOMContentLoaded', function (e) {
  (function () {
    // Form validation for Add new record
    if (formAuthentication) {
      fv = FormValidation.formValidation(formAuthentication, {
        fields: {
          username: {
            validators: {
              notEmpty: {
                message: 'Silakan isi username'
              },
              stringLength: {
                min: 2,
                message: 'Username harus lebih dari 2 karakter'
              }
            }
          },
          email: {
            validators: {
              notEmpty: {
                message: 'Silakan isi email'
              },
              emailAddress: {
                message: 'Silakan isi email yang valid'
              }
            }
          },
          'email-username': {
            validators: {
              notEmpty: {
                message: 'Please enter email / username'
              },
              stringLength: {
                min: 1,
                message: 'Username must be more than 1 characters'
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
          },
          'confirm-password': {
            validators: {
              notEmpty: {
                message: 'Please confirm password'
              },
              identical: {
                compare: function () {
                  return formAuthentication.querySelector('[name="password"]').value;
                },
                message: 'The password and its confirm are not the same'
              },
              stringLength: {
                min: 6,
                message: 'Password must be more than 6 characters'
              }
            }
          },
          terms: {
            validators: {
              notEmpty: {
                message: 'Please agree terms & conditions'
              }
            }
          }
        },
        plugins: {
          trigger: new FormValidation.plugins.Trigger(),
          bootstrap5: new FormValidation.plugins.Bootstrap5({
            eleValidClass: '',
            rowSelector: '.mb-6'
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

    //  Two Steps Verification
    const numeralMask = document.querySelectorAll('.numeral-mask');

    // Verification masking
    if (numeralMask.length) {
      numeralMask.forEach(e => {
        new Cleave(e, {
          numeral: true
        });
      });
    }
  })();
});

// Menghilangkan alert
$(document).ready(function () {
  window.setTimeout(function () {
    $('.alert-hilang')
      .fadeTo(1200, 0)
      .slideUp(750, function () {
        $(this).remove();
      });
  }, 5500);
});

// Handler untuk tombol login
$(document).ready(function () {
  $('#loginButton').on('click', function (e) {
    e.preventDefault();

    const button = $(this);
    const loader = button.find('.spinner-border');
    const form = button.closest('form');

    // Validasi form menggunakan instance global fv
    fv.validate()
      .then(function (status) {
        if (status === 'Valid') {
          button.find('.button-text').text('Memproses');
          loader.removeClass('d-none');
          button.prop('disabled', true);

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
