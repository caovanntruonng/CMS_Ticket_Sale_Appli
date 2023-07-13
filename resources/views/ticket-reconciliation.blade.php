@extends('templates.template')
@section('TicketReconciliationPage')

<div class="ticket-reconciliation-page">
    <div class="data-display">
        <h1>Đối soát vé</h1>
        <div class="ticket-filter">
            <form action="" method="get" class="search">
                <input type="search" name="search" id="" placeholder="Tìm bằng số vé">
                <button type="submit">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </form>
            <div class="">
                @if (session('eventName') === 'Tất cả' || session('eventName') === 'Chưa đối soát')
                <a href="{{ route('reconciliationStatus') }}">
                    <button type="button" class="button-hover">Chốt đối soát</button>
                </a>
                @elseif (session('eventName') === 'Đã đối soát')
                <a href="{{ route('exportCSV') }}">
                    <button type="button" class="button-hover">Xuất file (.csv)</button>
                </a>
                @endif
            </div>
        </div>
        <div class="ticket-board">
            <table class="table table-striped">
                <tr>
                    <th>STT</th>
                    <th>Số vé</th>
                    <th>Tên sự kiện</th>
                    <th>Ngày sử dụng</th>
                    <th>Loại vé</th>
                    <th>Cổng check - in</th>
                    <th></th>
                </tr>
                <?php $index = ($tickets->currentPage() - 1) * $tickets->perPage() + 1; ?>
                @foreach ($tickets as $ticket)
                <tr>
                    <td>{{ $index++ }}</td>
                    <td>{{ $ticket->{'ticket_code'} }}</td>
                    <td>{{ $ticket->{'event_name'} }}</td>
                    <td>{{ $ticket->{'start_date'} }}</td>
                    <td>{{ $ticket->{'ticket_type'} }}</td>
                    <td>{{ $ticket->{'check_in_gate'} }}</td>
                    <td>
                        @if ($ticket->{'reconciliation_status'} == 'Đã đối soát')
                        <div class="text-danger">
                            {{ $ticket->{'reconciliation_status'} }}
                        </div>
                        @elseif ($ticket->{'reconciliation_status'} == 'Chưa đối soát')
                        <div class="">
                            {{ $ticket->{'reconciliation_status'} }}
                        </div>
                        @endif
                    </td>
                </tr>
                @endforeach

            </table>

            {{-- Hiển thị các liên kết đến các trang --}}
            {{ $tickets->appends(request()->query())->links('vendor.pagination.custom_pagination') }}
        </div>
    </div>
    <div class="filter">
        <form action="{{ route('filterTicketReconciliationPage') }}" method="get">
            <h2>Lọc vé</h2>
            <table class="table table-borderless">
                <tbody>
                    <tr>
                        <td colspan="2">
                            <select name="select_event" id="" class="form-select">
                                <option value="Tất cả">Tất cả</option>

                                @foreach ($eventNames as $eventName)
                                <option value="{{ $eventName }}">{{ $eventName }}</option>
                                @endforeach

                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h3>Tình trạng đối soát</h3>
                        </td>
                        <td>
                            <div class="radio-group">
                                <div class="radio">
                                    <input type="radio" name="control-status" id="" value="Tất cả" checked>
                                    <span>Tất cả</span>
                                </div>
                                <div class="radio">
                                    <input type="radio" name="control-status" id="" value="Đã đối soát">
                                    <span>Đã đối soát</span>
                                </div>
                                <div class="radio">
                                    <input type="radio" name="control-status" id="" value="Chưa đối soát">
                                    <span>Chưa đối soát</span>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h3>Loại vé</h3>
                        </td>
                        <td>
                            <div>
                                <span>Vé cổng</span>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h3>Từ ngày</h3>
                        </td>
                        <td>
                            <div class="date">
                                <input type="text" name="start_date" id="checkTicketsDatePicker" class=""
                                    placeholder="dd/mm/yy">
                                <button>
                                    <i class="fa-regular fa-calendar"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h3>Đến ngày</h3>
                        </td>
                        <td>
                            <div class="date">
                                <input type="text" name="end_date" id="checkTicketsDatePicker" class=""
                                    placeholder="dd/mm/yy">
                                <button>
                                    <i class="fa-regular fa-calendar"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="submit">
                <button type="submit" class="button-hover">Lọc</button>
            </div>
        </form>
    </div>
</div>

@endsection