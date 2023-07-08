document.addEventListener("DOMContentLoaded", function () {
    var chartData = window.exportedChartData.lineChart;

    var ctx = document.getElementById("lineChart").getContext("2d");
    var lineChart;

    function lineChartUpdate(MonthYear) {
        var gradient = ctx.createLinearGradient(0, 0, 0, 400);
        gradient.addColorStop(0, "rgba(255, 139, 72, 0.5)");
        gradient.addColorStop(0, "rgba(255, 139, 72, 0.2)");
        gradient.addColorStop(1, "rgba(255, 139, 72, 0)");

        var month = MonthYear.month; // Tháng (từ 1 đến 12)
        var year = MonthYear.year; // Năm

        var labels = [];
        var dataset = [];

        var daysInMonth = new Date(year, month, 0).getDate(); // Số ngày trong tháng

        for (let day = 1; day <= daysInMonth; day++) {
            var label = day.toString().padStart(2, "0"); // Format ngày thành chuỗi có 2 chữ số (01, 02, ..., 31)
            labels.push(label);
            dataset.push(Math.floor(Math.random() * 1000000)); // Dữ liệu ngẫu nhiên từ 0 đến 99
        }

        var minData = Math.min(...dataset); // Tìm giá trị nhỏ nhất trong dataset
        var maxData = Math.max(...dataset); // Tìm giá trị lớn nhất trong mảng data
        var stepSize = maxData / 2; // Tính giá trị stepSize

        // Kiểm tra và hủy biểu đồ cũ nếu đã tồn tại
        if (lineChart) {
            lineChart.destroy();
        }

        // Tạo biểu đồ mới
        lineChart = new Chart(ctx, {
            type: "line",
            data: {
                labels: labels,
                datasets: [
                    {
                        label: "Doanh thu",
                        data: dataset,
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
                        ticks: {
                            stepSize: stepSize,
                        },
                        min: minData,
                        max: maxData + stepSize,
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

    function getMonthYearFromDate(dateString) {
        var dateParts = dateString.split("-"); // Tách chuỗi theo dấu "/"
        var month = dateParts[0]; // Lấy giá trị tháng
        var year = dateParts[1]; // Lấy giá trị năm

        return {
            month: month,
            year: year,
        };
    }

    var lineChartDatePicker = document.getElementById("lineChartDatePicker");

    // Lấy giá trị ngày tháng năm ban đầu
    var lineChartDate = lineChartDatePicker.value;
    var MonthYear = getMonthYearFromDate(lineChartDate);
    lineChartUpdate(MonthYear);

    lineChartDatePicker.addEventListener("change", function () {
        // Lấy giá trị ngày tháng năm
        var selectedDate = lineChartDatePicker.value;

        // Gọi hàm getMonthYearFromDate để lấy giá trị tháng và năm
        MonthYear = getMonthYearFromDate(selectedDate);
        lineChartUpdate(MonthYear);
    });
});
