@extends('templates.template')
@section('ServicesPage')

<div class="services-page">
    <h1>Danh sách gói vé</h1>
    <div class="ticket-filter">
        <form action="" method="get" class="search">
            <input type="search" name="search" id="" placeholder="Tìm bằng số vé">
            <button type="submit">
                <i class="fa-solid fa-magnifying-glass"></i>
            </button>
        </form>
        <div class="filter">
            <a href="{{ route('exportCSV') }}">
                <button type="button" class="button-hover">Xuất file (.csv)</button>
            </a>
            <button type="button" class="button-hover" data-bs-toggle="modal" data-bs-target="#myAddTicketPackage">
                Thêm gói vé
            </button>
        </div>
    </div>
    <div class="ticket-board">
        <table class="table table-striped">
            <tr>
                <th>STT</th>
                <th>Mã gói</th>
                <th>Tên gói vé</th>
                <th>Tên sự kiện</th>
                <th>Ngày áp dụng</th>
                <th>Ngày hết hạn</th>
                <th>Giá vé (VNĐ/Vé)</th>
                <th>Giá Combo (VNĐ/Combo)</th>
                <th>Tình trạng</th>
                <th></th>
            </tr>
            <?php $index = ($ticket_packages->currentPage() - 1) * $ticket_packages->perPage() + 1; ?>
            @foreach ($ticket_packages as $ticket)
            <tr>
                <td>{{ $index++ }}</td>
                <td>{{ $ticket->{'package_code'} }}</td>
                <td>{{ $ticket->{'package_name'} }}</td>
                <td>{{ $ticket->{'event_name'} }}</td>
                <td>{{ $ticket->{'start_date'} }}</td>
                <td>{{ $ticket->{'end_date'} }}</td>
                <td>
                    @if ($ticket->{'ticket_price'})
                    {{ $ticket->{'ticket_price'} . ' VNĐ' }}
                    @endif
                </td>
                <td>
                    @if ($ticket->{'combo_price_amount'} && $ticket->{'combo_price_tickets'})
                    {{ $ticket->{'combo_price_amount'} . ' VNĐ / ' . $ticket->{'combo_price_tickets'} . " vé"}}
                    @endif
                </td>
                <td> @if ($ticket->{'status'} == 'Đang áp dụng')
                    <div class="status active">
                        <i class="fa-solid fa-circle fa-2xs"></i>&ensp;{{ $ticket->{'status'} }}
                    </div>
                    @else
                    <div class="status disabled">
                        <i class="fa-solid fa-circle fa-2xs"></i>&ensp;{{ $ticket->{'status'} }}
                    </div>
                    @endif
                </td>
                <td>
                    <button type="button" class="update" data-bs-toggle="modal" data-bs-target="#myUpdateTicketPackage"
                        data-package-code="{{ $ticket->{'package_code'} }}"
                        data-event-name="{{ $ticket->{'event_name'} }}" data-start-date="{{ $ticket->{'start_date'} }}"
                        data-end-date="{{ $ticket->{'end_date'} }}" data-ticket-price="{{ $ticket->{'ticket_price'} }}"
                        data-combo-price-amount="{{ $ticket->{'combo_price_amount'} }}"
                        data-combo-price-tickets="{{ $ticket->{'combo_price_tickets'} }}"
                        data-status="{{ $ticket->{'status'} }}">
                        <i class="fa-regular fa-pen-to-square"></i>&nbsp;Cập nhật
                    </button>
                </td>
            </tr>
            @endforeach
        </table>

        @include('modals.update-ticket-package')

        <script>
            var myUpdate = document.getElementById('myUpdateTicketPackage');
            myUpdate.addEventListener('show.bs.modal', function (event) {
                var button = event.relatedTarget;
                var packageCode = button.getAttribute('data-package-code');
                var eventName = button.getAttribute('data-event-name');
                var startDate = button.getAttribute('data-start-date');
                var endDate = button.getAttribute('data-end-date');
                var ticketPrice = button.getAttribute('data-ticket-price');
                var comboPriceAmount = button.getAttribute('data-combo-price-amount');
                var comboPriceTickets = button.getAttribute('data-combo-price-tickets');
                var status = button.getAttribute('data-status');

                var packageCodeInput = myUpdate.querySelector('#packageCodeInput');
                packageCodeInput.value = packageCode;

                var eventNameInput = myUpdate.querySelector('#eventNameInput');
                eventNameInput.value = eventName;

                var ticketPriceInput = myUpdate.querySelector('#ticketPriceInput');
                ticketPriceInput.value = ticketPrice;

                var comboPriceAmountInput = myUpdate.querySelector('#comboPriceAmountInput');
                comboPriceAmountInput.value = comboPriceAmount;

                var comboPriceTicketsInput = myUpdate.querySelector('#comboPriceTicketsInput');
                comboPriceTicketsInput.value = comboPriceTickets;

                var statusInput = myUpdate.querySelector('#statusInput');
                statusInput.value = status;

                var startDateInput = myUpdate.querySelector('.startDateInput');
                startDateInput.value = formatDay(startDate);

                var endDateInput = myUpdate.querySelector('.endDateInput');
                endDateInput.value = formatDay(endDate);

                var startTimeInput = myUpdate.querySelector('.startTimeInput');
                startTimeInput.value = formatTime(startDate);

                var endTimeInput = myUpdate.querySelector('.endTimeInput');
                endTimeInput.value = formatTime(endDate);
            });
            
            function formatDay(dateString) {
                const dateTime = new Date(dateString);
                const day = dateTime.getDate();
                const month = dateTime.getMonth() + 1;
                const year = dateTime.getFullYear();
                const formattedDate = `${day}/${month}/${year}`;

                return formattedDate;
            }

            function formatTime(dateString) {
                const dateTime = new Date(dateString);
                const hours = String(dateTime.getHours()).padStart(2, '0');
                const minutes = String(dateTime.getMinutes()).padStart(2, '0');
                const seconds = String(dateTime.getSeconds()).padStart(2, '0');
                const formattedTime = `${hours}:${minutes}:${seconds}`;

                return formattedTime;
            }
        </script>

        {{-- Hiển thị các liên kết đến các trang --}}
        {{ $ticket_packages->appends(request()->query())->links('vendor.pagination.custom_pagination') }}

    </div>
</div>

@include('modals.add-ticket-package')

@endsection