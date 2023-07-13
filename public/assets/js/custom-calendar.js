document.addEventListener("DOMContentLoaded", function () {
    const customVietnameseLocale = {
        weekdays: {
            shorthand: ["CN", "T2", "T3", "T4", "T5", "T6", "T7"],
            longhand: [
                "Chủ Nhật",
                "Thứ Hai",
                "Thứ Ba",
                "Thứ Tư",
                "Thứ Năm",
                "Thứ Sáu",
                "Thứ Bảy",
            ],
        },
        months: {
            shorthand: [
                "Th1",
                "Th2",
                "Th3",
                "Th4",
                "Th5",
                "Th6",
                "Th7",
                "Th8",
                "Th9",
                "Th10",
                "Th11",
                "Th12",
            ],
            longhand: [
                "Tháng 1",
                "Tháng 2",
                "Tháng 3",
                "Tháng 4",
                "Tháng 5",
                "Tháng 6",
                "Tháng 7",
                "Tháng 8",
                "Tháng 9",
                "Tháng 10",
                "Tháng 11",
                "Tháng 12",
            ],
        },
        firstDayOfWeek: 1,
    };
    const today = new Date();
    const time = today.getTime();
    flatpickr("#lineChartDatePicker", {
        dateFormat: "m-Y",
        locale: customVietnameseLocale,
        defaultDate: today,
    });
    flatpickr("#pieChartDatePicker", {
        dateFormat: "m-Y",
        locale: customVietnameseLocale,
        defaultDate: today,
    });
    flatpickr("#startDatePicker", {
        dateFormat: "d/m/Y",
        locale: customVietnameseLocale,
        defaultDate: today,
    });
    flatpickr("#endDatePicker", {
        dateFormat: "d/m/Y",
        locale: customVietnameseLocale,
        defaultDate: today,
    });
    flatpickr("#checkTicketsDatePicker", {
        dateFormat: "d/m/Y",
        locale: customVietnameseLocale,
        defaultDate: today,
    });
    flatpickr("#updateDatePicker", {
        dateFormat: "d/m/Y",
        locale: customVietnameseLocale,
        defaultDate: today,
    });
    flatpickr("#addPackageDatePicker", {
        dateFormat: "d/m/Y",
        locale: customVietnameseLocale,
        defaultDate: today,
    });
    flatpickr("#addPackageTimePicker", {
        enableTime: true,
        noCalendar: true,
        dateFormat: "H:i:S",
        time_24hr: true,
        defaultDate: time,
    });
    flatpickr("#updatePackageDatePicker", {
        dateFormat: "d/m/Y",
        locale: customVietnameseLocale,
    });
    flatpickr("#updatePackageTimePicker", {
        enableTime: true,
        noCalendar: true,
        dateFormat: "H:i:S",
        time_24hr: true,
    });
});
