<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;

class MyController extends Controller
{
    public function showIndex()
    {
        // Gọi function và lấy dữ liệu trả về
        $pieChart = $this->processPieChartData();

        $lineChart = $this->processLineChartData();

        return view('index', compact('lineChart', 'pieChart'));
    }

    public function showTicketManagementPage()
    {
        $tickets = DB::table('tickets')->paginate(8);

        $distinctUsageStatus = DB::table('tickets')->distinct()->pluck('usage_status');
        $distinctCheckIn = DB::table('tickets')->distinct()->pluck('check_in_gate');

        return view('ticket-management', compact('tickets', 'distinctUsageStatus', 'distinctCheckIn'));
    }

    public function showTicketReconciliationPage()
    {
        return view('ticket-reconciliation');
    }

    public function showEventListPage()
    {
        return view('event-list');
    }

    public function showDeviceManagementPage()
    {
        return view('device-management');
    }

    public function showServicesPage()
    {
        return view('services');
    }

    public function handleFilterData(Request $request)
    {
        $distinctUsageStatus = DB::table('tickets')->distinct()->pluck('usage_status');
        $distinctCheckIn = DB::table('tickets')->distinct()->pluck('check_in_gate');

        // Lấy dữ liệu từ request
        $startDate = $request->input('start-date');
        $endDate = $request->input('end-date');
        $status = $request->input('status-checkbox');
        $checkIn = $request->input('check-in-checkbox');

        // Chuyển đổi định dạng ngày trong biểu mẫu thành định dạng tương ứng trong cơ sở dữ liệu
        $formattedStartDate = Carbon::createFromFormat('d/m/Y', $startDate)->format('Y-m-d') . ' 00:00:00';
        $formattedEndDate = Carbon::createFromFormat('d/m/Y', $endDate)->format('Y-m-d') . ' 23:59:59';

        // Xử lý dữ liệu và thực hiện các hành động khác
        $ticketsQuery = DB::table('tickets');

        $ticketsQuery->where('start_date', '>=', $formattedStartDate);
        $ticketsQuery->where('end_date', '<=', $formattedEndDate);
        if ($status && $status !== 'Tất cả') {
            $ticketsQuery->where('usage_status', $status);
        }
        if ($checkIn != 'Tất cả' && $checkIn != '') {
            $ticketsQuery->where('check_in_gate', $checkIn);
        }

        $tickets = $ticketsQuery->paginate(8);

        // Trả về kết quả hoặc chuyển hướng đến một trang khác
        return view('ticket-management', compact('tickets', 'distinctUsageStatus', 'distinctCheckIn'));
    }

    public function processPieChartData()
    {
        // Pie chart
        $pieChart = DB::table('tickets')
            ->join('ticket_packages', 'tickets.package_code', '=', 'ticket_packages.package_code')
            ->select('ticket_packages.package_code', 'ticket_packages.package_name', 'tickets.usage_status', DB::raw('DATE(tickets.start_date) as start_date'), DB::raw('COUNT(ticket_packages.id) as total_tickets'))
            ->whereIn('tickets.usage_status', ['Đã sử dụng', 'Chưa sử dụng', 'Hết hạn'])
            ->groupBy('ticket_packages.package_code', 'ticket_packages.package_name', 'tickets.usage_status', 'start_date')
            ->get();

        // Xử lý dữ liệu
        $result = [];
        foreach ($pieChart as $item) {
            $packageCode = $item->package_code;
            $packageName = $item->package_name;
            $status = $item->usage_status;
            $startDate = $item->start_date;
            $totalTickets = $item->total_tickets;

            $monthYear = date('m-Y', strtotime($startDate));

            if (!isset($result[$packageCode])) {
                $result[$packageCode] = [
                    'package_code' => $packageCode,
                    'package_name' => $packageName,
                    'total_tickets_by_status' => [],
                ];
            }

            // Chỉ lấy hai trạng thái "Đã sử dụng" và "Chưa sử dụng"
            if ($status === 'Đã sử dụng' || $status === 'Chưa sử dụng') {
                if (!isset($result[$packageCode]['total_tickets_by_status'][$status])) {
                    $result[$packageCode]['total_tickets_by_status'][$status] = [
                        'total_tickets_by_date' => [],
                    ];
                }

                if (!isset($result[$packageCode]['total_tickets_by_status'][$status]['total_tickets_by_date'][$monthYear])) {
                    $result[$packageCode]['total_tickets_by_status'][$status]['total_tickets_by_date'][$monthYear] = 0;
                }

                $result[$packageCode]['total_tickets_by_status'][$status]['total_tickets_by_date'][$monthYear] += $totalTickets;
            }
        }

        // Chuyển kết quả về dạng array
        $pieChart = array_values($result);
        return $pieChart;
    }

    public function processLineChartData()
    {
        $ticketTotals = DB::table('tickets')
            ->join('ticket_packages', 'tickets.package_code', '=', 'ticket_packages.package_code')
            ->select(DB::raw('DATE(tickets.start_date) AS date'), DB::raw('SUM(ticket_packages.ticket_price) AS total_price'))
            ->groupBy('date')
            ->get();
    
        $result = [];
        foreach ($ticketTotals as $item) {
            $date = $item->date;
            $totalPrice = $item->total_price;
    
            $result[$date] = $totalPrice;
        }
    
        return $result;
    }
    
}
