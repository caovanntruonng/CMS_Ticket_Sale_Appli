<!-- The Modal -->
<div class="modal fade ticket-update-modal" id="myUpdate">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="{{ route('updateStartDate') }}" method="POST">
                @csrf
                <!-- Modal Header -->
                <div class="modal-header">
                    <h1 class="modal-title">Đổi ngày sử dụng vé</h1>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <table>
                        <tr>
                            <td>
                                <h4>Số vé</h4>
                            </td>
                            <td>
                                <span id="ticketCode"></span>
                                <input type="text" name="ticket-code" class="ticketCodeInput">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h4>Mã gói vé</h4>
                            </td>
                            <td>
                                <span id="packageCode"></span>
                                <input type="text" name="package-code" class="packageCodeInput">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h4>Tên sự kiện</h4>
                            </td>
                            <td>
                                <span id="eventName"></span>
                                <input type="text" name="event-name" class="eventNameInput">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h4>Ngày sử dụng</h4>
                            </td>
                            <td>
                                <div class="date">
                                    <input type="text" name="start-date" id="updateDatePicker" class="startDateInput"
                                        value="">
                                    <button>
                                        <i class="fa-regular fa-calendar"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </table>
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