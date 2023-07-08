document.addEventListener("DOMContentLoaded", function () {
    var chartData = window.exportedChartData.pieChart;

    var pieChartsContainer = document.querySelector(".pieCharts");
    var pieCharts = pieChartsContainer.getElementsByClassName("pieChart");

    var pieChartDatePicker = document.getElementById("pieChartDatePicker");

    var pieChartsInstances = []; // Mảng chứa các đối tượng biểu đồ Chart

    function pieChartUpdate(pieChartDate) {
        // Hủy tất cả các biểu đồ cũ trước khi cập nhật
        pieChartsInstances.forEach(function (chart) {
            chart.destroy();
        });

        pieChartsInstances = []; // Đặt lại mảng đối tượng biểu đồ Chart

        Array.from(chartData).forEach(function (data, index) {
            // Lọc dữ liệu theo thời gian
            var filteredData = {};
            Object.keys(data.total_tickets_by_status).forEach(function (
                status
            ) {
                var ticketsByDate =
                    data.total_tickets_by_status[status].total_tickets_by_date;
                if (ticketsByDate.hasOwnProperty(pieChartDate)) {
                    filteredData[status] = ticketsByDate[pieChartDate];
                }
            });

            // Kiểm tra xem có dữ liệu đã lọc hay không
            var hasData = Object.keys(filteredData).length > 0;

            // Nếu có dữ liệu, tạo biểu đồ pie chart
            if (hasData) {
                var ctx = pieCharts[index].getContext("2d");

                var pieChart = new Chart(ctx, {
                    type: "doughnut",
                    data: {
                        labels: Object.keys(filteredData),
                        datasets: [
                            {
                                data: Object.values(filteredData),
                                backgroundColor: ["#4F75FF", "#FF8A48"],
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
                                text: data.package_name,
                            },
                        },
                    },
                });

                pieChartsInstances.push(pieChart); // Thêm biểu đồ vào mảng đối tượng biểu đồ Chart

                // Xóa lớp "hiddenCanvas" nếu tồn tại
                pieCharts[index].classList.remove("hiddenCanvas");
            } else {
                pieCharts[index].classList.add("hiddenCanvas");
            }
        });
    }

    var pieChartDatePicker = document.getElementById("pieChartDatePicker");

    // Lấy giá trị ngày tháng năm ban đầu
    var pieChartDate = pieChartDatePicker.value;
    pieChartUpdate(pieChartDate);

    pieChartDatePicker.addEventListener("change", function () {
        // Lấy giá trị ngày tháng năm
        var selectedDate = pieChartDatePicker.value;

        // Gọi hàm getMonthYearFromDate để lấy giá trị tháng và năm
        pieChartUpdate(selectedDate);
    });
});
