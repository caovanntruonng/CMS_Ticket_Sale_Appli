document.addEventListener("DOMContentLoaded", function () {
  // Dữ liệu
  var title = ["Gói gia đình", "Gói sự kiện"];
  var ve_su_kien = [];
  var ve_gia_dinh = [];

  var labels = ["Vé đã sử dụng", "Vé chưa sử dụng"];
  var backgroundColor = ["#4F75FF", "#FF8A48"];

  function createData(params) {
    for (let day = 1; day <= 2; day++) {
      params.push(Math.floor(Math.random() * 100000)); // Dữ liệu ngẫu nhiên từ 0 đến 99
    }
  }

  createData(ve_su_kien);

  // Biểu đồ gói vé sự kiện
  var ctxSuKien = document.getElementById("chart-su-kien").getContext("2d");
  var chartSuKien = new Chart(ctxSuKien, {
    type: "doughnut",
    data: {
      labels: labels,
      datasets: [
        {
          data: ve_su_kien,
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
          text: title[0],
        },
      },
    },
  });

  createData(ve_gia_dinh);

  // Biểu đồ gói vé gia đình
  var ctxGiaDinh = document.getElementById("chart-gia-dinh").getContext("2d");
  var chartGiaDinh = new Chart(ctxGiaDinh, {
    type: "doughnut",
    data: {
      labels: labels,
      datasets: [
        {
          label: "Doanh thu",
          data: ve_gia_dinh,
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
          text: title[1],
        },
      },
    },
  });
});
