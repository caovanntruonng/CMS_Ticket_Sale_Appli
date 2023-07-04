document.addEventListener("DOMContentLoaded", function () {
  // Lấy tất cả các thẻ a trong menu
  const menuLinks = document.querySelectorAll(".menu .menu-link");

  // Lặp qua từng thẻ a và gắn sự kiện click
  menuLinks.forEach((link) => {
    link.addEventListener("click", function () {
      // Loại bỏ lớp .active từ tất cả các thẻ a
      menuLinks.forEach((link) => {
        link.classList.remove("active");
      });
      // Thêm lớp .active cho thẻ a được nhấp vào
      this.classList.add("active");
    });
  });
});
