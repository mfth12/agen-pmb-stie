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
            var value = window.localStorage["stie/sistem-stie-" + key] || themeConfig[key];
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
                window.localStorage.setItem("stie/sistem-stie-" + key, value);
                url.searchParams.set(key, value);
            }
        }
        window.history.pushState({}, "", url);
    });
    resetButton.addEventListener("click", function () {
        for (var key in themeConfig) {
            var value = themeConfig[key];
            document.documentElement.removeAttribute("data-bs-" + key);
            window.localStorage.removeItem("stie/sistem-stie-" + key);
            url.searchParams.delete(key);
        }
        checkItems();
        window.history.pushState({}, "", url);
    });
    checkItems();
});