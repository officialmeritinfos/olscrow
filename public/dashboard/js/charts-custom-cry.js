(function($) {
    "use strict";

    // Area Sparkline Chart-1
    var options = {
        series: [
            { name: "BTC", 
                data: [12, 14, 2, 47, 42, 15, 47, 75, 65, 19, 14] 
            }
        ],
        chart: { 
            type: "area", 
            height: 140, 
            sparkline: { 
                enabled: !0 
            } 
        },
        stroke: { 
            curve: "smooth", 
            width: 2 
        },
        colors: [
            "#f90283"
        ],
        fill: { 
            type: "gradient", 
            gradient: { 
                shadeIntensity: 1, 
                inverseColors: !1, 
                opacityFrom: 1, 
                opacityTo: 1, 
                stops: [
                    25, 100, 100, 100
                ] 
            } 
        },
        tooltip: { 
            fixed: { 
                enabled: !1 
            }, 
            x: { 
                show: !1 
            }, 
            marker: { 
                show: !1 
            } 
        },
    },
    chart = new ApexCharts(
        document.querySelector("#area-sparkline-chart-1"), 
        options
    );
    chart.render();

    // Area Sparkline Chart-2
    var options = {
        series: [
            { name: "BTC", 
                data: [12, 14, 2, 47, 42, 15, 47, 75, 65, 19, 14] 
            }
        ],
        chart: { 
            type: "area", 
            height: 140, 
            sparkline: { 
                enabled: !0 
            } 
        },
        stroke: { 
            curve: "smooth", 
            width: 2 
        },
        colors: [
            "#21bdfd"
        ],
        fill: { 
            type: "gradient", 
            gradient: { 
                shadeIntensity: 1, 
                inverseColors: !1, 
                opacityFrom: 1, 
                opacityTo: 1, 
                stops: [
                    25, 100, 100, 100
                ] 
            } 
        },
        tooltip: { 
            fixed: { 
                enabled: !1 
            }, 
            x: { 
                show: !1 
            }, 
            marker: { 
                show: !1 
            } 
        },
    },
    chart = new ApexCharts(
        document.querySelector("#area-sparkline-chart-2"), 
        options
    );
    chart.render();

    // Area Sparkline Chart-3
    var options = {
        series: [
            { name: "BTC", 
                data: [12, 14, 2, 47, 42, 15, 47, 75, 65, 19, 14] 
            }
        ],
        chart: { 
            type: "area", 
            height: 140, 
            sparkline: { 
                enabled: !0 
            } 
        },
        stroke: { 
            curve: "smooth", 
            width: 2 
        },
        colors: [
            "#fab134"
        ],
        fill: { 
            type: "gradient", 
            gradient: { 
                shadeIntensity: 1, 
                inverseColors: !1, 
                opacityFrom: 1, 
                opacityTo: 1, 
                stops: [
                    25, 100, 100, 100
                ] 
            } 
        },
        tooltip: { 
            fixed: { 
                enabled: !1 
            }, 
            x: { 
                show: !1 
            }, 
            marker: { 
                show: !1 
            } 
        },
    },
    chart = new ApexCharts(
        document.querySelector("#area-sparkline-chart-3"), 
        options
    );
    chart.render();

    // Stacked Column Chart 2
    var options = {
        chart: { 
            height: 385, 
            type: "bar", 
            stacked: !0, 
            toolbar: { 
                show: !1 
            }, 
            zoom: { 
                enabled: !0 
            } 
        },
        plotOptions: { 
            bar: { 
                horizontal: !1, 
                columnWidth: "15%", 
                endingShape: "rounded" 
            } 
        },
        dataLabels: { 
            enabled: !1 
        },
        series: [
            { name: "Bitcoin", data: [50, 30, 30, 50, 50, 43, 36, 52, 24, 18, 36, 48] },
            { name: "Ethereum", data: [40, 30, 70, 80, 50, 0, 0, 0, 0, 0, 0, 0] },
            { name: "Litecoin", data: [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0] },
            { name: "Dashcoin", data: [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0] },
        ],
        colors: [
            "#EE7071", 
            "#8A80F3", 
            "#FF9F43", 
            "#21BDFD",
        ],
        legend: { position: "top"},
        fill: { opacity: 1 },
    },
    chart = new ApexCharts(
        document.querySelector("#stacked-column-chart"), 
        options
    );
    chart.render();

    // Target Chart
    var walletOptions = {
        series: [70, 60, 50],
        chart: { 
            height: 302, 
            type: "radialBar" 
        },
        plotOptions: {
            radialBar: {
                offsetY: 0,
                startAngle: 0,
                endAngle: 400,
                hollow: { 
                    margin: 5, 
                    size: "10%", 
                    background: "transparent", 
                    image: void 0 
                },
                track: { 
                    show: !0, 
                    startAngle: void 0, 
                    endAngle: void 0, 
                    background: "#f2f2f2", 
                    strokeWidth: "97%", 
                    opacity: 1, 
                    margin: 15, 
                    dropShadow: { 
                        enabled: !1, 
                        top: 0, 
                        left: 0, 
                        blur: 3, 
                        opacity: 0.5 
                    } 
                },
                dataLabels: {
                    name: { 
                        show: !0, 
                        fontSize: "16px", 
                        fontWeight: 600, 
                        offsetY: -10 
                    },
                    value: {
                        show: !0,
                        fontSize: "14px",
                        offsetY: 4,
                        formatter: function (e) {
                            return e + "%";
                        },
                    },
                },
            },
        },
        stroke: { 
            lineCap: "round" 
        },
        colors: [
            "#F90283", 
            "#21BDFD", 
            "#FAB134"
        ],
        labels: [
            "Weekly", 
            "Monthly", 
            "Yearly"
        ],
        legend: { 
            show: !1 
        },
    };
    (chart = new ApexCharts(
        document.querySelector("#target-chart"), 
            walletOptions
        )
    );
    chart.render();

    // Country Chart
    options = { 
        series: [30, 45, 10, 15], 
        chart: { 
            type: "donut", 
            height: 262 
        }, 
        labels: [
            "Canada", 
            "Others", 
            "United States", 
            "Asian Country"
        ], 
        colors: [
            "#21BDFD", 
            "#7F26C6", 
            "#FB5264", 
            "#FAB134"
        ], 
        legend: { 
            show: !1 
        }, 
        plotOptions: { 
            pie: { 
                donut: { 
                    size: "70%" 
                } 
            } 
        } 
    };
    (chart = new ApexCharts(
        document.querySelector("#country-chart"), 
            options
        )
    );
    chart.render();

}(jQuery));