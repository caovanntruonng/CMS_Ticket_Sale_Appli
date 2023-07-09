document.addEventListener("DOMContentLoaded", function () {
    var chartData = window.exportedChartData.lineChart;

    var ctx = document.getElementById("lineChart").getContext("2d");
    var lineChart;

    function lineChartUpdate(selectedDate) {
        var gradient = ctx.createLinearGradient(0, 0, 0, 400);
        gradient.addColorStop(0, "rgba(255, 139, 72, 0.5)");
        gradient.addColorStop(0, "rgba(255, 139, 72, 0.2)");
        gradient.addColorStop(1, "rgba(255, 139, 72, 0)");

        // Lọc dữ liệu theo tháng và năm
        var filteredData = {};
        Object.keys(chartData).forEach(function (date) {
            var monthYear = date.substring(0, 7); // Lấy chuỗi tháng và năm (ví dụ: "2023-07")
            if (monthYear === selectedDate) {
                filteredData[date] = chartData[date];
            }
        });

        // Kiểm tra và hủy biểu đồ cũ nếu đã tồn tại
        if (lineChart) {
            lineChart.destroy();
        }

        // Tạo biểu đồ mới với dữ liệu đã lọc
        lineChart = new Chart(ctx, {
            type: "line",
            data: {
                labels: Object.keys(filteredData),
                datasets: [
                    {
                        label: "Doanh thu",
                        data: Object.values(filteredData),
                        backgroundColor: gradient,
                        borderColor: "#FF993C",
                        borderWidth: 2,
                        fill: "start",
                        pointRadius: 0,
                        tension: 0.1,
                    },
                ],
            },
            options: {
                maintainAspectRatio: false,
                scales: {
                    x: {
                        grid: {
                            display: false,
                        },
                    },
                    y: {
                        beginAtZero: true, // Bắt đầu từ 0 trên trục y
                    },
                },
                plugins: {
                    legend: {
                        display: false, // Ẩn chú thích
                    },
                    tooltip: {
                        enabled: true, // Kích hoạt tooltip
                        mode: "index",
                        intersect: false,
                    },
                },
            },
        });
    }

    function formatDate(dateString) {
        var parts = dateString.split("-");
        var month = parseInt(parts[0]);
        var year = parseInt(parts[1]);

        return year + "-" + month.toString().padStart(2, "0");
    }

    var lineChartDatePicker = document.getElementById("lineChartDatePicker");

    // Lấy giá trị ngày tháng năm ban đầu
    var selectedDate = formatDate(lineChartDatePicker.value);
    lineChartUpdate(selectedDate);

    lineChartDatePicker.addEventListener("change", function () {
        // Lấy giá trị ngày tháng năm
        var selectedDate = formatDate(lineChartDatePicker.value);

        // Gọi hàm lineChartUpdate để cập nhật biểu đồ
        lineChartUpdate(selectedDate);
    });
});
