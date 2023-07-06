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
            <button><i class="fa-solid fa-filter"></i>&ensp;Lọc vé</button>
            <button>Xuất file (.csv)</button>
        </div>
    </div>
    <div class="ticket-board">
        <table class="table table-striped">
            <tr>
                <th>STT</th>
                <th>Booking code</th>
                <th>Số vé</th>
                <th>Tên sự kiện</th>
                <th>Tình trạng sử dụng</th>
                <th>Ngày sử dụng</th>
                <th>Ngày xuất vé</th>
                <th>Cổng check - in</th>
            </tr>
            <tr>
                <td>1</td>
                <td>ALT20210501</td>
                <td>123456789034</td>
                <td>Hội chợ triển lãm tiêu dùng 2021</td>
                <td>
                    <div class="status">
                        <i class="fa-solid fa-circle fa-2xs"></i>&ensp;Đã sử dụng
                    </div>
                </td>
                <td>14/04/2021</td>
                <td>14/04/2021</td>
                <td>Cổng 1</td>
            </tr>
            <tr>
                <td>1</td>
                <td>ALT20210501</td>
                <td>123456789034</td>
                <td>Hội chợ triển lãm tiêu dùng 2021</td>
                <td>
                    <div class="status">
                        <i class="fa-solid fa-circle fa-2xs"></i>&ensp;Đã sử dụng
                    </div>
                </td>
                <td>14/04/2021</td>
                <td>14/04/2021</td>
                <td>Cổng 1</td>
            </tr>
            <tr>
                <td>1</td>
                <td>ALT20210501</td>
                <td>123456789034</td>
                <td>Hội chợ triển lãm tiêu dùng 2021</td>
                <td>
                    <div class="status">
                        <i class="fa-solid fa-circle fa-2xs"></i>&ensp;Đã sử dụng
                    </div>
                </td>
                <td>14/04/2021</td>
                <td>14/04/2021</td>
                <td>Cổng 1</td>
            </tr>
            <tr>
                <td>1</td>
                <td>ALT20210501</td>
                <td>123456789034</td>
                <td>Hội chợ triển lãm tiêu dùng 2021</td>
                <td>
                    <div class="status">
                        <i class="fa-solid fa-circle fa-2xs"></i>&ensp;Đã sử dụng
                    </div>
                </td>
                <td>14/04/2021</td>
                <td>14/04/2021</td>
                <td>Cổng 1</td>
            </tr>
            <tr>
                <td>1</td>
                <td>ALT20210501</td>
                <td>123456789034</td>
                <td>Hội chợ triển lãm tiêu dùng 2021</td>
                <td>
                    <div class="status">
                        <i class="fa-solid fa-circle fa-2xs"></i>&ensp;Đã sử dụng
                    </div>
                </td>
                <td>14/04/2021</td>
                <td>14/04/2021</td>
                <td>Cổng 1</td>
            </tr>
            <tr>
                <td>1</td>
                <td>ALT20210501</td>
                <td>123456789034</td>
                <td>Hội chợ triển lãm tiêu dùng 2021</td>
                <td>
                    <div class="status">
                        <i class="fa-solid fa-circle fa-2xs"></i>&ensp;Đã sử dụng
                    </div>
                </td>
                <td>14/04/2021</td>
                <td>14/04/2021</td>
                <td>Cổng 1</td>
            </tr>
        </table>
    </div>
</div>

@endsection