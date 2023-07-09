@extends('templates.template')
@section('TicketManagementPage')

<div class="ticket-management">
    <h1>Danh sách vé</h1>
    <div class="ticket-package-list">
        <div>
            <a href="">Gói gia đình</a>
        </div>
        <div>
            <a href="">Gói sự kiện</a>
        </div>
    </div>
    <div class="ticket-filter">
        <form action="" method="get" class="search">
            <input type="search" name="search" id="" placeholder="Tìm bằng số vé">
            <button type="submit">
                <i class="fa-solid fa-magnifying-glass"></i>
            </button>
        </form>
        <div class="filter">
            <button type="button" class="button-hover" data-bs-toggle="modal" data-bs-target="#myModal">
                <i class="fa-solid fa-filter"></i>&ensp;Lọc vé
            </button>
            <button type="button" class="button-hover">Xuất file (.csv)</button>
        </div>
    </div>
    <div class="ticket-board">
        <table class="table table-striped">
            <tr>
                <th>STT</th>
                <th>Mã gói vé</th>
                <th>Số vé</th>
                <th>Tên sự kiện</th>
                <th>Tình trạng sử dụng</th>
                <th>Ngày sử dụng</th>
                <th>Hạn sử dụng</th>
                <th>Cổng check - in</th>
            </tr>

            <?php $index = ($tickets->currentPage() - 1) * $tickets->perPage() + 1; ?>
            @foreach ($tickets as $ticket)
            <tr>
                <td>{{ $index++ }}</td>
                <td>{{ $ticket->{'package_code'} }}</td>
                <td>{{ $ticket->{'ticket_code'} }}</td>
                <td>{{ $ticket->{'event_name'} }}</td>
                <td>

                    @if ($ticket->{'usage_status'} == 'Đã sử dụng')
                    <div class="status used">
                        <i class="fa-solid fa-circle fa-2xs"></i>&ensp;{{ $ticket->{'usage_status'} }}
                    </div>
                    @elseif ($ticket->{'usage_status'} == 'Chưa sử dụng')
                    <div class="status unused">
                        <i class="fa-solid fa-circle fa-2xs"></i>&ensp;{{ $ticket->{'usage_status'} }}
                    </div>
                    @else
                    <div class="status expired">
                        <i class="fa-solid fa-circle fa-2xs"></i>&ensp;{{ $ticket->{'usage_status'} }}
                    </div>
                    @endif

                </td>
                <td>{{ $ticket->{'start_date'} }}</td>
                <td>{{ $ticket->{'end_date'} }}</td>
                <td>{{ $ticket->{'check_in_gate'} }}</td>
            </tr>
            @endforeach

        </table>

        {{-- Hiển thị các liên kết đến các trang --}}
        {{ $tickets->appends(request()->query())->links('vendor.pagination.custom_pagination') }}

    </div>
</div>

@include('modals.ticket-filter-modal')

@endsection