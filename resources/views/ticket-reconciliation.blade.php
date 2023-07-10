@extends('templates.template')
@section('TicketReconciliationPage')

<div class="ticket-reconciliation">
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
                <button type="button" class="button-hover">Chốt đối soát</button>
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
                <tr>
                    <td>1</td>
                    <td>205314876321</td>
                    <td>Hội chợ triển lãm tiêu dùng 2021</td>
                    <td>14/04/2021</td>
                    <td>Vé cổng</td>
                    <td>Cổng 1</td>
                    <td>Chưa đối soát</td>
                </tr>
            </table>
        </div>
    </div>
    <div class="filter">
        <form action="" method="get">
            <h2>Lọc vé</h2>
            <select name="" id="" class="form-select">
                <option value="">Hội chợ triển lãm tiêu dùng 2021</option>
                <option value="">Hội chợ triển lãm tiêu dùng 2022</option>
                <option value="">Hội chợ triển lãm tiêu dùng 2023</option>
            </select>
            <div class="">
                <table class="table table-borderless">
                    <tbody>
                        <tr>
                            <td>
                                <h3>Tình trạng đối soát</h3>
                            </td>
                            <td>
                                <div class="radio-group">
                                    <div class="radio">
                                        <input type="radio" name="control-status" id="" checked>
                                        <span>Tất cả</span>
                                    </div>
                                    <div class="radio">
                                        <input type="radio" name="control-status" id="">
                                        <span>Đã đối soát</span>
                                    </div>
                                    <div class="radio">
                                        <input type="radio" name="control-status" id="">
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
                                    <input type="text" name="date" id="checkTicketsDatePicker" class="">
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
                                    <input type="text" name="date" id="checkTicketsDatePicker" class="">
                                    <button>
                                        <i class="fa-regular fa-calendar"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="submit">
                <button type="submit" class="button-hover">Lọc</button>
            </div>
        </form>
    </div>
</div>

@endsection