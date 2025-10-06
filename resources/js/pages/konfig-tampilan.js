document.addEventListener("DOMContentLoaded", function () {
    var themeConfig = {
        theme: "light",
        "theme-base": "gray",
        "theme-font": "sans-serif",
        "theme-primary": "blue",
        "theme-radius": "1",
    };
    var url = new URL(window.location);
    var form = document.getElementById("offcanvasSettings");
    var resetButton = document.getElementById("reset-changes");
    var checkItems = function () {
        for (var key in themeConfig) {
            var value = window.localStorage["tabler-" + key] || themeConfig[key];
            if (!!value) {
                var radios = form.querySelectorAll(`[name="${key}"]`);
                if (!!radios) {
                    radios.forEach((radio) => {
                        radio.checked = radio.value === value;
                    });
                }
            }
        }
    };
    form.addEventListener("change", function (event) {
        var target = event.target,
            name = target.name,
            value = target.value;
        for (var key in themeConfig) {
            if (name === key) {
                document.documentElement.setAttribute("data-bs-" + key, value);
                window.localStorage.setItem("tabler-" + key, value);
                url.searchParams.set(key, value);

                // jika yang diubah adalah tema, ubah juga turnstile widget
                // jika yang diubah adalah tema, ubah juga turnstile widget
                if (key === "theme") {
                    console.log('turnstile widget ikut theme:', value);

                    var widget = document.getElementById("cf-turnstile-widget");
                    if (widget) {
                        // Ambil parent
                        var parent = widget.parentNode;

                        // Ambil semua atribut penting
                        var siteKey = widget.getAttribute("data-sitekey");
                        var size = widget.getAttribute("data-size") || "flexible";
                        var refresh = widget.getAttribute("data-refresh-expired") || "auto";
                        var callback = widget.getAttribute("data-callback") || "";
                        var language = widget.getAttribute("data-language") || "en-US";

                        // Hapus widget lama
                        widget.remove();

                        // Buat ulang elemen baru dengan tema baru
                        var newWidget = document.createElement("div");
                        newWidget.id = "cf-turnstile-widget";
                        newWidget.className = "cf-turnstile";
                        newWidget.style.minWidth = "100px";
                        newWidget.setAttribute("data-sitekey", siteKey);
                        newWidget.setAttribute("data-size", size);
                        newWidget.setAttribute("data-refresh-expired", refresh);
                        newWidget.setAttribute("data-callback", callback);
                        newWidget.setAttribute("data-theme", value);
                        newWidget.setAttribute("data-language", language);

                        // Tambahkan kembali ke DOM
                        parent.appendChild(newWidget);

                        // Render ulang Turnstile
                        if (typeof turnstile !== "undefined") {
                            turnstile.render(newWidget);
                        }
                    }
                }

            }
        }
        window.history.pushState({}, "", url);
    });
    resetButton.addEventListener("click", function () {
        for (var key in themeConfig) {
            var value = themeConfig[key];
            document.documentElement.removeAttribute("data-bs-" + key);
            window.localStorage.removeItem("tabler-" + key);
            url.searchParams.delete(key);
        }
        checkItems();
        window.history.pushState({}, "", url);
    });
    checkItems();
});