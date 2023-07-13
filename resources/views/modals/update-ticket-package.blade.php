<!-- The Modal -->
<div class="modal fade update-ticket-package" id="myUpdateTicketPackage">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="{{ route('updateTicketPackage') }}" method="POST">
                @csrf
                <!-- Modal Header -->
                <div class="modal-header">
                    <h1 class="modal-title">Cập nhật thông tin gói vé</h1>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <div class="package-info">
                        <div class="package-code">
                            <h4>Mã sự kiện<span class="text-danger">&nbsp;*</span></h4>
                            <input type="text" name="package-code" id="packageCodeInput" class="" placeholder="Nhập mã gói vé" readonly>
                        </div>
                        <div class="event-name">
                            <h4>Tên sự kiện</h4>
                            <input type="text" name="event-name" id="eventNameInput" class="" placeholder="Nhập tên gói vé">
                        </div>
                    </div>
                    <div class="date-modal">
                        <div class="start-date">
                            <h4>Ngày áp dụng</h4>
                            <div>
                                <div class="date">
                                    <input type="text" name="start-date" id="updatePackageDatePicker" class="startDateInput"
                                        placeholder="dd/mm/yy">
                                    <button>
                                        <i class="fa-regular fa-calendar"></i>
                                    </button>
                                </div>
                                <div class="date">
                                    <input type="text" name="start-time" id="updatePackageTimePicker" class="startTimeInput"
                                        placeholder="hh:mm:ss">
                                    <button>
                                        <i class="fa-regular fa-clock"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="end-date">
                            <h4>Ngày hết hạn</h4>
                            <div>
                                <div class="date">
                                    <input type="text" name="end-date" id="updatePackageDatePicker" class="endDateInput"
                                        placeholder="dd/mm/yy">
                                    <button>
                                        <i class="fa-regular fa-calendar"></i>
                                    </button>
                                </div>
                                <div class="date">
                                    <input type="text" name="end-time" id="updatePackageTimePicker" class="endTimeInput"
                                        placeholder="hh:mm:ss">
                                    <button>
                                        <i class="fa-regular fa-clock"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="price">
                        <h4>Giá vé áp dụng</h4>
                        <div class="single">
                            <input type="checkbox" name="single" id="">
                            <span>Vé lẻ (vnđ/vé) với giá</span>
                            <input type="number" name="price-single" id="ticketPriceInput" class="no-spinners" placeholder="Giá vé">
                            <span>/vé</span>
                        </div>
                        <div class="combo">
                            <input type="checkbox" name="combo" id="">
                            <span>Combo vé với giá</span>
                            <input type="number" name="price-combo" id="comboPriceAmountInput" class="no-spinners" placeholder="Giá vé">
                            <span>/</span>
                            <input type="number" name="quantity-combo" id="comboPriceTicketsInput" class="no-spinners" placeholder="Số lượng">
                            <span>vé</span>
                        </div>
                    </div>
                    <div class="status">
                        <h4>Tình trạng</h4>
                        <select name="status" id="statusInput" class="form-select">
                            <option value="Đang áp dụng">Đang áp dụng</option>
                            <option value="Tắt">Tắt</option>
                        </select>
                    </div>
                    <div class="note"><span class="text-danger">*&nbsp;</span><span>là thông tin bắt buộc</span></div>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="button-hover" data-bs-dismiss="modal">Hủy</button>
                    <button type="submit" class="button-hover active">Lưu</button>
                </div>
            </form>
        </div>
    </div>
</div>