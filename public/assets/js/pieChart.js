document.addEventListener("DOMContentLoaded", function () {
    var chartData = window.exportedChartData.pieChart;

    var pieChartsContainer = document.querySelector(".pieCharts");
    var pieCharts = pieChartsContainer.getElementsByClassName("pieChart");

    for (let index = 0; index < chartData.length; index++) {

        var ctx = pieCharts[index].getContext("2d");

        var labels = ["Vé đã sử dụng", "Vé chưa sử dụng"];
        var backgroundColor = ["#4F75FF", "#FF8A48"];

        console.log(chartData[index].ve);

        var chart = new Chart(ctx, {
            type: "doughnut",
            data: {
                labels: labels,
                datasets: [
                    {
                        data: chartData[index].ve,
                        backgroundColor: backgroundColor,
                    },
                ],
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false,
                    },
                    title: {
                        display: true,
                        text: chartData[index].title,
                    },
                },
            },
        });
    }
});
