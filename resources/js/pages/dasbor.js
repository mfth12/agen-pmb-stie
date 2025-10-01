/**
 * Halaman otentikasi masuk
 */
'use strict';
document.addEventListener("DOMContentLoaded", function () {
    window.ApexCharts &&
        new ApexCharts(document.getElementById("chart-visitors"), {
            chart: {
                type: "line",
                fontFamily: "inherit",
                height: 96,
                sparkline: {
                    enabled: true,
                },
                animations: {
                    enabled: false,
                },
            },
            stroke: {
                width: [2, 1],
                dashArray: [0, 3],
                lineCap: "round",
                curve: "smooth",
            },
            series: [
                {
                    name: "Visitors",
                    data: [
                        7687, 7543, 7545, 7543, 7635, 8140, 7810, 8315, 8379, 8441, 8485, 8227, 8906, 8561, 8333, 8551, 9305, 9647, 9359, 9840, 9805, 8612, 8970,
                        8097, 8070, 9829, 10545, 10754, 10270, 9282,
                    ],
                },
                {
                    name: "Visitors last month",
                    data: [
                        8630, 9389, 8427, 9669, 8736, 8261, 8037, 8922, 9758, 8592, 8976, 9459, 8125, 8528, 8027, 8256, 8670, 9384, 9813, 8425, 8162, 8024, 8897,
                        9284, 8972, 8776, 8121, 9476, 8281, 9065,
                    ],
                },
            ],
            tooltip: {
                theme: "dark",
            },
            grid: {
                strokeDashArray: 4,
            },
            xaxis: {
                labels: {
                    padding: 0,
                },
                tooltip: {
                    enabled: false,
                },
                type: "datetime",
            },
            yaxis: {
                labels: {
                    padding: 4,
                },
            },
            labels: [
                "2020-06-20",
                "2020-06-21",
                "2020-06-22",
                "2020-06-23",
                "2020-06-24",
                "2020-06-25",
                "2020-06-26",
                "2020-06-27",
                "2020-06-28",
                "2020-06-29",
                "2020-06-30",
                "2020-07-01",
                "2020-07-02",
                "2020-07-03",
                "2020-07-04",
                "2020-07-05",
                "2020-07-06",
                "2020-07-07",
                "2020-07-08",
                "2020-07-09",
                "2020-07-10",
                "2020-07-11",
                "2020-07-12",
                "2020-07-13",
                "2020-07-14",
                "2020-07-15",
                "2020-07-16",
                "2020-07-17",
                "2020-07-18",
                "2020-07-19",
            ],
            colors: ["color-mix(in srgb, transparent, var(--tblr-primary) 100%)", "color-mix(in srgb, transparent, var(--tblr-gray-400) 100%)"],
            legend: {
                show: false,
            },
        }).render();
});
document.addEventListener("DOMContentLoaded", function () {
    window.ApexCharts &&
        new ApexCharts(document.getElementById("chart-active-users-3"), {
            chart: {
                type: "radialBar",
                fontFamily: "inherit",
                height: 192,
                sparkline: {
                    enabled: true,
                },
                animations: {
                    enabled: false,
                },
            },
            plotOptions: {
                radialBar: {
                    startAngle: -120,
                    endAngle: 120,
                    hollow: {
                        margin: 16,
                        size: "50%",
                    },
                    dataLabels: {
                        show: true,
                        value: {
                            offsetY: -8,
                            fontSize: "24px",
                        },
                    },
                },
            },
            series: [78],
            labels: [""],
            tooltip: {
                theme: "dark",
            },
            grid: {
                strokeDashArray: 4,
            },
            colors: ["color-mix(in srgb, transparent, var(--tblr-primary) 100%)"],
            legend: {
                show: false,
            },
        }).render();
});


document.addEventListener("DOMContentLoaded", function () {
    window.ApexCharts &&
        new ApexCharts(document.getElementById("chart-revenue-bg"), {
            chart: {
                type: "area",
                fontFamily: "inherit",
                height: 40,
                sparkline: {
                    enabled: true,
                },
                animations: {
                    enabled: false,
                },
            },
            dataLabels: {
                enabled: false,
            },
            fill: {
                colors: ["color-mix(in srgb, transparent, var(--tblr-primary) 16%)", "color-mix(in srgb, transparent, var(--tblr-primary) 16%)"],
                type: "solid",
            },
            stroke: {
                width: 2,
                lineCap: "round",
                curve: "smooth",
            },
            series: [
                {
                    name: "Profits",
                    data: [37, 35, 44, 28, 36, 24, 65, 31, 37, 39, 62, 51, 35, 41, 35, 27, 93, 53, 61, 27, 54, 43, 19, 46, 39, 62, 51, 35, 41, 67],
                },
            ],
            tooltip: {
                theme: "dark",
            },
            grid: {
                strokeDashArray: 4,
            },
            xaxis: {
                labels: {
                    padding: 0,
                },
                tooltip: {
                    enabled: false,
                },
                axisBorder: {
                    show: false,
                },
                type: "datetime",
            },
            yaxis: {
                labels: {
                    padding: 4,
                },
            },
            labels: [
                "2020-06-20",
                "2020-06-21",
                "2020-06-22",
                "2020-06-23",
                "2020-06-24",
                "2020-06-25",
                "2020-06-26",
                "2020-06-27",
                "2020-06-28",
                "2020-06-29",
                "2020-06-30",
                "2020-07-01",
                "2020-07-02",
                "2020-07-03",
                "2020-07-04",
                "2020-07-05",
                "2020-07-06",
                "2020-07-07",
                "2020-07-08",
                "2020-07-09",
                "2020-07-10",
                "2020-07-11",
                "2020-07-12",
                "2020-07-13",
                "2020-07-14",
                "2020-07-15",
                "2020-07-16",
                "2020-07-17",
                "2020-07-18",
                "2020-07-19",
            ],
            colors: ["color-mix(in srgb, transparent, var(--tblr-primary) 100%)"],
            legend: {
                show: false,
            },
        }).render();
});


document.addEventListener("DOMContentLoaded", function () {
    window.ApexCharts &&
        new ApexCharts(document.getElementById("chart-new-clients"), {
            chart: {
                type: "line",
                fontFamily: "inherit",
                height: 40,
                sparkline: {
                    enabled: true,
                },
                animations: {
                    enabled: false,
                },
            },
            stroke: {
                width: [2, 1],
                dashArray: [0, 3],
                lineCap: "round",
                curve: "smooth",
            },
            series: [
                {
                    name: "May",
                    data: [37, 35, 44, 28, 36, 24, 65, 31, 37, 39, 62, 51, 35, 41, 35, 27, 93, 53, 61, 27, 54, 43, 4, 46, 39, 62, 51, 35, 41, 67],
                },
                {
                    name: "April",
                    data: [93, 54, 51, 24, 35, 35, 31, 67, 19, 43, 28, 36, 62, 61, 27, 39, 35, 41, 27, 35, 51, 46, 62, 37, 44, 53, 41, 65, 39, 37],
                },
            ],
            tooltip: {
                theme: "dark",
            },
            grid: {
                strokeDashArray: 4,
            },
            xaxis: {
                labels: {
                    padding: 0,
                },
                tooltip: {
                    enabled: false,
                },
                type: "datetime",
            },
            yaxis: {
                labels: {
                    padding: 4,
                },
            },
            labels: [
                "2020-06-20",
                "2020-06-21",
                "2020-06-22",
                "2020-06-23",
                "2020-06-24",
                "2020-06-25",
                "2020-06-26",
                "2020-06-27",
                "2020-06-28",
                "2020-06-29",
                "2020-06-30",
                "2020-07-01",
                "2020-07-02",
                "2020-07-03",
                "2020-07-04",
                "2020-07-05",
                "2020-07-06",
                "2020-07-07",
                "2020-07-08",
                "2020-07-09",
                "2020-07-10",
                "2020-07-11",
                "2020-07-12",
                "2020-07-13",
                "2020-07-14",
                "2020-07-15",
                "2020-07-16",
                "2020-07-17",
                "2020-07-18",
                "2020-07-19",
            ],
            colors: ["color-mix(in srgb, transparent, var(--tblr-primary) 100%)", "color-mix(in srgb, transparent, var(--tblr-gray-600) 100%)"],
            legend: {
                show: false,
            },
        }).render();
});


document.addEventListener("DOMContentLoaded", function () {
    window.ApexCharts &&
        new ApexCharts(document.getElementById("chart-active-users"), {
            chart: {
                type: "bar",
                fontFamily: "inherit",
                height: 40,
                sparkline: {
                    enabled: true,
                },
                animations: {
                    enabled: false,
                },
            },
            plotOptions: {
                bar: {
                    columnWidth: "50%",
                },
            },
            dataLabels: {
                enabled: false,
            },
            series: [
                {
                    name: "Profits",
                    data: [37, 35, 44, 28, 36, 24, 65, 31, 37, 39, 62, 51, 35, 41, 35, 27, 93, 53, 61, 27, 54, 43, 19, 46, 39, 62, 51, 35, 41, 67],
                },
            ],
            tooltip: {
                theme: "dark",
            },
            grid: {
                strokeDashArray: 4,
            },
            xaxis: {
                labels: {
                    padding: 0,
                },
                tooltip: {
                    enabled: false,
                },
                axisBorder: {
                    show: false,
                },
                type: "datetime",
            },
            yaxis: {
                labels: {
                    padding: 4,
                },
            },
            labels: [
                "2020-06-20",
                "2020-06-21",
                "2020-06-22",
                "2020-06-23",
                "2020-06-24",
                "2020-06-25",
                "2020-06-26",
                "2020-06-27",
                "2020-06-28",
                "2020-06-29",
                "2020-06-30",
                "2020-07-01",
                "2020-07-02",
                "2020-07-03",
                "2020-07-04",
                "2020-07-05",
                "2020-07-06",
                "2020-07-07",
                "2020-07-08",
                "2020-07-09",
                "2020-07-10",
                "2020-07-11",
                "2020-07-12",
                "2020-07-13",
                "2020-07-14",
                "2020-07-15",
                "2020-07-16",
                "2020-07-17",
                "2020-07-18",
                "2020-07-19",
            ],
            colors: ["color-mix(in srgb, transparent, var(--tblr-primary) 100%)"],
            legend: {
                show: false,
            },
        }).render();
});



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