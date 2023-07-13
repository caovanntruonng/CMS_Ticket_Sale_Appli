@extends('templates.template')
@section('HomePage')

<div class="home-page">
    <h1>Thống kê</h1>
    <div class="revenue">
        <span>Doanh thu</span>
        <div class="date">
            <input type="text" name="date" id="lineChartDatePicker" class="">
            <button>
                <i class="fa-regular fa-calendar"></i>
            </button>
        </div>
    </div>
    <div class="lineChartContainer">
        <canvas id="lineChart" class=""></canvas>
    </div>
    <div class="total-weekly-revenue">
        <span>Tổng doanh thu theo tuần</span>
        <div class="revenue-money">
            <h1 class="monthlyTotal">521.000.000</h1>
            <span>&nbsp;đồng</span>
        </div>
    </div>
    <div class="pieChartContainer">
        <div class="date">
            <input type="text" name="date" id="pieChartDatePicker" class="">
            <button>
                <i class="fa-regular fa-calendar"></i>
            </button>
        </div>
        <div class="pieCharts">

            @foreach ($pieChart as $item)
            <canvas id="{{ $item['package_code'] }}" class="pieChart"></canvas>
            @endforeach

        </div>
        <div class="note">
            <div class="used-ticket-notes d-flex">
                <div></div>
                &nbsp;Vé đã sử dụng
            </div>
            <div class="unused-ticket-notes d-flex">
                <div></div>
                &nbsp;Vé chưa sử dụng
            </div>
        </div>
    </div>
</div>

<script>
    var chartData = {
        lineChart: {!! json_encode($lineChart) !!},
        pieChart: {!! json_encode($pieChart) !!},
    };
    window.exportedChartData = chartData;
</script>

@endsection