<!-- The Modal -->
<div class="modal fade ticket-filter-modal" id="myModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="{{ route('FilterData') }}" method="GET">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Lọc vé</h4>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <div class="modal-date">
                        <div class="modal-start-date">
                            <h1>Từ ngày</h1>
                            <div class="date">
                                <input type="text" name="start-date" id="startDatePicker" class="">
                                <button type="button">
                                    <i class="fa-regular fa-calendar"></i>
                                </button>
                            </div>
                        </div>
                        <div class="modal-end-date">
                            <h1>Đến ngày</h1>
                            <div class="date">
                                <input type="text" name="end-date" id="endDatePicker" class="">
                                <button type="button">
                                    <i class="fa-regular fa-calendar"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="status">
                        <h1>Tình trạng sử dụng</h1>
                        <div class="radio">
                            <div><input type="radio" name="status-checkbox" id="" value="Tất cả" checked>
                                <span>Tất cả</span>
                            </div>

                            @foreach ($distinctUsageStatus as $status)
                            <div>
                                <input type="radio" name="status-checkbox" id="" value="{{ $status }}">
                                <span>{{ $status }}</span>
                            </div>
                            @endforeach

                        </div>
                    </div>
                    <div class="check-in">
                        <h1>Cổng Check - in</h1>
                        <div class="checkbox">
                            <div><input type="checkbox" name="check-in-checkbox" id="" value="Tất cả" checked>
                                <span>Tất cả</span>
                            </div>

                            @foreach ($distinctCheckIn as $CheckIn)
                            <div>
                                <input type="checkbox" name="check-in-checkbox" id="" value="{{ $CheckIn }}">
                                <span>{{ $CheckIn }}</span>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="submit" class="button-hover">Lọc</button>
                </div>
            </form>
        </div>
    </div>
</div>