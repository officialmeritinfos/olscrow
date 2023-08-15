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
(chart = new ApexCharts(document.querySelector("#target-chart"), walletOptions));chart.render();