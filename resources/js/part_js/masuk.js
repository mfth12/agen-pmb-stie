var allowSubmit = true;
document.querySelector('#tombolmasuk').addEventListener('click', function (event) {
    if (allowSubmit) {
        console.log("Melakukan akses masuk ke sistem.");
        return true;
    }

    console.log("Izin masuk tertolak.");
    event.preventDefault();
    return false;
});

// untuk panggilan tooltip
$(function () {
    $('.close').on("click", function (event) {
        window.setTimeout(function () {
            $(".alert").fadeTo(700, 0).slideUp(700, function () {
                $(this).remove();
            });
        }, 1200);
        console.log("close triggered");
        event.preventDefault();
    });
});
