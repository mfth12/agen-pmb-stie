
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

// untuk fadeout alert
$(document).ready(function () {
    window.setTimeout(function () {
        $(".alert-hilang").fadeTo(1200, 0).slideUp(750, function () {
            $(this).remove();
        });
    }, 3500); // alert menghilang dalam 3.5 detik
});

// toggle password
$(document).ready(function () {
    $('#toggle-password').on('click', function () {
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