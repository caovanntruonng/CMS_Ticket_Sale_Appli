document.addEventListener("DOMContentLoaded", function () {
  const ctx = document.getElementById("lineChart").getContext("2d");

  const gradient = ctx.createLinearGradient(0, 0, 0, 400);
  gradient.addColorStop(0, "rgba(255, 139, 72, 0.5)");
  gradient.addColorStop(0, "rgba(255, 139, 72, 0.2)");
  gradient.addColorStop(1, "rgba(255, 139, 72, 0)");

  const month = 7; // Tháng (từ 1 đến 12)
  const year = 2023; // Năm

  const labels = [];
  const dataset = [];

  const daysInMonth = new Date(year, month, 0).getDate(); // Số ngày trong tháng

  for (let day = 1; day <= daysInMonth; day++) {
    const label = day.toString().padStart(2, "0"); // Format ngày thành chuỗi có 2 chữ số (01, 02, ..., 31)
    labels.push(label);
    dataset.push(Math.floor(Math.random() * 100)); // Dữ liệu ngẫu nhiên từ 0 đến 99
  }
  const minData = Math.min(...dataset); // Tìm giá trị nhỏ nhất trong dataset
  const maxData = Math.max(...dataset); // Tìm giá trị lớn nhất trong mảng data
  const stepSize = maxData / 2; // Tính giá trị stepSize

  const data = {
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
  };

  const options = {
    layout: {
      padding: {
        left: -25,
      },
    },
    maintainAspectRatio: false,
    scales: {
      x: {
        grid: {
          display: false,
        },
        ticks: {
          padding: 10,
        },
      },
      y: {
        beginAtZero: true, // Bắt đầu từ 0 trên trục y
        ticks: {
          stepSize: stepSize,
          callback: function (value) {
            return value.toFixed(0) + "tr";
          },
          padding: 25,
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
        callbacks: {
          label: function (context) {
            let label = context.dataset.label || "";
            if (label) {
              label += ": ";
            }
            if (context.parsed.y !== null) {
              label += context.parsed.y + "tr";
            }
            return label;
          },
        },
      },
    },
  };

  const lineChart = new Chart(ctx, {
    type: "line",
    data: data,
    options: options,
  });
});
