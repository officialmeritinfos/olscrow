(function($) {
    "use strict";

    // Ana Dash 1
    var options = {
        chart: { 
            height: 395, 
            type: "area", 
            stacked: !0, 
            toolbar: { 
                show: !1, 
                autoSelected: "zoom" 
            } 
        },
        colors: [
            "#7f26c6", 
            "#7f26c6"
        ],
        dataLabels: { 
            enabled: !1 
        },
        stroke: { 
            curve: "smooth", 
            width: [1.5, 1.5], 
            dashArray: [0, 4], 
            lineCap: "round"
        },
        grid: { 
            padding: { 
                left: 0, 
                right: 0 
            }, 
            strokeDashArray: 3 
        },
        markers: { 
            size: 0, 
            hover: { 
                size: 0 
            } 
        },
        series: [
            { name: "New Visits", data: [0, 60, 20, 90, 45, 110, 55, 130, 44, 110, 75, 120] },
            { name: "Unique Visits", data: [0, 45, 10, 75, 35, 94, 40, 115, 30, 105, 65, 110] },
        ],
        xaxis: { 
            type: "month", 
            categories: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"], axisBorder: { 
                show: !0 
            }, 
            axisTicks: { 
                show: !0 
            } 
        },
        fill: { 
            type: "gradient", 
            gradient: { 
                shadeIntensity: 1, 
                opacityFrom: 0, 
                opacityTo: 0, 
                stops: [0, 90, 100] 
            } 
        },
        tooltip: { 
            x: { 
                format: "dd/MM/yy HH:mm" 
            } 
        },
        legend: { 
            position: "bottom", 
            horizontalAlign: "right",  
            show: false 
        },
    };
    (chart = new ApexCharts(
        document.querySelector("#ana_dash_1"), 
        options)
    );
    chart.render();

    // Stacked Column Chart
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
            { name: "Retained Clients", data: [50, 30, 30, 50, 50, 43, 36, 52, 24, 18, 36, 48] },
            { name: "New Clients", data: [40, 30, 70, 80, 50, 0, 0, 0, 0, 0, 0, 0] },
        ],
        xaxis: { 
            categories: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"] 
        },
        colors: ["#EE7071", "#8A80F3"],
        legend: { position: "top"},
        fill: { opacity: 1 },
    },
    chart = new ApexCharts(
        document.querySelector("#stacked-column-chart"), 
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
            { name: "Retained Clients", data: [50, 30, 30, 50, 50, 43, 36, 52] },
        ],
        
        colors: ["#ff9f43"],
        legend: { position: "top"},
        fill: { opacity: 1 },
    },
    chart = new ApexCharts(
        document.querySelector("#stacked-column-chart-2"), 
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