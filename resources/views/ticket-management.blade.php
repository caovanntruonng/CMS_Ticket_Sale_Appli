@extends('templates.template')
@section('TicketManagementPage')

<div class="ticket-management-page">
    <h1>Danh sách vé</h1>
    <div class="ticket-package-list">

        @foreach ($ticketPackages as $ticketPackage)
        <div class="{{ session('packageCode') === $ticketPackage->package_code ? 'active' : '' }}">
            <a href="{{ route('showTicketPackage', ['package_code' => $ticketPackage->package_code]) }}">
                {{ $ticketPackage->package_name }}
            </a>
        </div>
        @endforeach

    </div>
    <div class="ticket-filter">
        <form action="" method="get" class="search">
            <input type="search" name="search" id="" placeholder="Tìm bằng số vé">
            <button type="submit">
                <i class="fa-solid fa-magnifying-glass"></i>
            </button>
        </form>
        <div class="filter">
            <button type="button" class="button-hover" data-bs-toggle="modal" data-bs-target="#myFilter">
                <i class="fa-solid fa-filter"></i>&ensp;Lọc vé
            </button> 
            <a href="{{ route('exportCSV') }}">
                <button type="button" class="button-hover">Xuất file (.csv)</button>
            </a>
        </div>
    </div>
    <div class="ticket-board">
        <table class="table table-striped table-hover">
            <tr>
                <th>STT</th>
                <th>Mã gói vé</th>
                <th>Số vé</th>
                <th>Tên sự kiện</th>
                <th>Tình trạng sử dụng</th>
                <th>Ngày sử dụng</th>
                <th>Hạn sử dụng</th>
                <th>Cổng check - in</th>
                <th></th>
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
                <td>
                    <button class="ellipsis" data-bs-toggle="modal" data-bs-target="#myUpdate"
                        data-ticket-code="{{ $ticket->{'ticket_code'} }}"
                        data-event-name="{{ $ticket->{'event_name'} }}"
                        data-package-code="{{ $ticket->{'package_code'} }}"
                        data-start-date="{{ $ticket->{'start_date'} }}">
                        <i class="fa-solid fa-ellipsis-vertical"></i>
                    </button>
                </td>
            </tr>
            @endforeach
        </table>

        @include('modals.ticket-update-modal')

        <script>
            var myUpdate = document.getElementById('myUpdate');
            myUpdate.addEventListener('show.bs.modal', function (event) {
                var button = event.relatedTarget;
                var ticketCode = button.getAttribute('data-ticket-code');
                var packageCode = button.getAttribute('data-package-code');
                var eventName = button.getAttribute('data-event-name');
                var startDate = button.getAttribute('data-start-date');

                // span
                var ticketCodeElement = myUpdate.querySelector('#ticketCode');
                ticketCodeElement.textContent = ticketCode;

                var packageCodeElement = myUpdate.querySelector('#packageCode');
                packageCodeElement.textContent = packageCode;

                var eventNameElement = myUpdate.querySelector('#eventName');
                eventNameElement.textContent = eventName;

                // input
                var ticketCodeInput = myUpdate.querySelector('.ticketCodeInput');
                ticketCodeInput.value = ticketCode;

                var packageCodeInput = myUpdate.querySelector('.packageCodeInput');
                packageCodeInput.value = packageCode;

                var eventNameInput = myUpdate.querySelector('.eventNameInput');
                eventNameInput.value = eventName;

                var startDateInput = myUpdate.querySelector('.startDateInput');
                startDateInput.value = formatDate(startDate);
            });
            
            function formatDate(dateString) {
                var date = new Date(dateString);
                var day = date.getDate();
                var month = date.getMonth() + 1;
                var year = date.getFullYear();

                var formattedDate = ('0' + day).slice(-2) + '/' + ('0' + month).slice(-2) + '/' + year;

                return formattedDate;
            }
        </script>

        {{-- Hiển thị các liên kết đến các trang --}}
        {{ $tickets->appends(request()->query())->links('vendor.pagination.custom_pagination') }}

    </div>
</div>

@include('modals.ticket-filter-modal')


@endsection