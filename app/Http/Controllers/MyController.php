<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Http\Response;

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
        $ticketPackage = DB::table('ticket_packages')->first();
        $packageCode = $ticketPackage ? $ticketPackage->package_code : null;

        $ticketsQuery = DB::table('tickets');

        if ($packageCode) {
            session(['packageCode' => $packageCode]);
            $ticketsQuery->leftJoin('ticket_packages', 'tickets.package_code', '=', 'ticket_packages.package_code')
                ->select('tickets.*', 'ticket_packages.event_name')
                ->where('tickets.package_code', $packageCode);
        }

        // export
        $exportData = DB::table('tickets')
            ->leftJoin('ticket_packages', 'tickets.package_code', '=', 'ticket_packages.package_code')
            ->select('tickets.*', 'ticket_packages.event_name')
            ->where('tickets.package_code', $packageCode)->get();

        $data = [[
            'id',
            'package_code',
            'ticket_code',
            'event_name',
            'usage_status',
            'start_date',
            'end_date',
            'check_in_gate',
        ]];
        foreach ($exportData as $ticket) {
            $data[] = [
                $ticket->id,
                $ticket->package_code,
                "'" . $ticket->ticket_code,
                $ticket->event_name,
                $ticket->usage_status,
                $ticket->start_date,
                $ticket->end_date,
                $ticket->check_in_gate,
            ];
        }
        session(['exportData' => $data]);

        $tickets = $this->paginate($ticketsQuery);

        $distinctUsageStatus = DB::table('tickets')->distinct()->pluck('usage_status');
        $distinctCheckIn = DB::table('tickets')->distinct()->pluck('check_in_gate');

        $ticketPackages = DB::table('ticket_packages')->get();

        return view('ticket-management', compact('tickets', 'distinctUsageStatus', 'distinctCheckIn', 'ticketPackages'));
    }

    public function showTicketReconciliationPage()
    {
        $ticketsQuery = DB::table('tickets')
            ->leftJoin('ticket_packages', 'tickets.package_code', '=', 'ticket_packages.package_code')
            ->select('tickets.*', 'ticket_packages.event_name');

        session(['eventName' => 'Tất cả']);

        // export
        $exportData = DB::table('tickets')
        ->leftJoin('ticket_packages', 'tickets.package_code', '=', 'ticket_packages.package_code')
        ->select('tickets.*', 'ticket_packages.event_name')->get();

        $data = [[
            'id',
            'ticket_code',
            'event_name',
            'start_date',
            'ticket_type',
            'check_in_gate',
            'reconciliation_status	'
        ]];
        foreach ($exportData as $ticket) {
            $data[] = [
                $ticket->id,
                "'" . $ticket->ticket_code,
                $ticket->event_name,
                $ticket->start_date,
                $ticket->ticket_type,
                $ticket->check_in_gate,
                $ticket->reconciliation_status,
            ];
        }
        session(['exportData' => $data]);

        $tickets = $this->paginateReconciliation($ticketsQuery);

        $eventNames = DB::table('ticket_packages')->pluck('event_name')->all();

        return view('ticket-reconciliation', compact('tickets', 'eventNames'));
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
        $ticketsQuery = DB::table('ticket_packages');

        // export
        $exportData = $ticketsQuery->get();

        $data = [[
            'id',
            'package_code',
            'package_name',
            'event_name',
            'start_date',
            'end_date',
            'ticket_price',
            'combo_price_amount',
            'combo_price_tickets',
            'status'
        ]];
        foreach ($exportData as $ticket) {
            $data[] = [
                $ticket->id,
                $ticket->package_code,
                $ticket->package_name,
                $ticket->event_name,
                $ticket->start_date,
                $ticket->end_date,
                $ticket->ticket_price,
                $ticket->combo_price_amount,
                $ticket->combo_price_tickets,
                $ticket->status,
            ];
        }
        session(['exportData' => $data]);
        
        $ticket_packages = $this->paginate($ticketsQuery);

        return view('services', compact('ticket_packages'));
    }

    public function filterTicketManagementPage(Request $request)
    {
        $distinctUsageStatus = DB::table('tickets')->distinct()->pluck('usage_status');
        $distinctCheckIn = DB::table('tickets')->distinct()->pluck('check_in_gate');

        // Lấy dữ liệu từ request
        $startDate = $request->input('start-date');
        $endDate = $request->input('end-date');
        $status = $request->input('status-radio');
        $checkIn = $request->input('check-in-checkbox');

        // Chuyển đổi định dạng ngày trong biểu mẫu thành định dạng tương ứng trong cơ sở dữ liệu
        $formattedStartDate = Carbon::createFromFormat('d/m/Y', $startDate)->format('Y-m-d') . ' 00:00:00';
        $formattedEndDate = Carbon::createFromFormat('d/m/Y', $endDate)->format('Y-m-d') . ' 23:59:59';

        // Xử lý dữ liệu và thực hiện các hành động khác
        $ticketsQuery = DB::table('tickets')
            ->leftJoin('ticket_packages', 'tickets.package_code', '=', 'ticket_packages.package_code')
            ->select('tickets.*', 'ticket_packages.event_name');

        $packageCode = session('packageCode');

        if (isset($packageCode)) {
            $ticketsQuery->where('tickets.package_code', $packageCode);
        }

        $ticketsQuery->where('tickets.start_date', '>=', $formattedStartDate);
        $ticketsQuery->where('tickets.end_date', '<=', $formattedEndDate);
        if ($status && $status !== 'Tất cả') {
            $ticketsQuery->where('tickets.usage_status', $status);
        }
        if ($checkIn != 'Tất cả' && $checkIn != '') {
            $ticketsQuery->where('tickets.check_in_gate', $checkIn);
        }

        // export
        $exportData = $ticketsQuery->get();

        $data = [[
            'id',
            'package_code',
            'ticket_code',
            'event_name',
            'usage_status',
            'start_date',
            'end_date',
            'check_in_gate',
        ]];
        foreach ($exportData as $ticket) {
            $data[] = [
                $ticket->id,
                $ticket->package_code,
                "'" . $ticket->ticket_code,
                $ticket->event_name,
                $ticket->usage_status,
                $ticket->start_date,
                $ticket->end_date,
                $ticket->check_in_gate,
            ];
        }
        session(['exportData' => $data]);

        $tickets = $this->paginate($ticketsQuery);

        $ticketPackages = DB::table('ticket_packages')->get();

        // Trả về kết quả hoặc chuyển hướng đến một trang khác
        return view('ticket-management', compact('tickets', 'distinctUsageStatus', 'distinctCheckIn', 'ticketPackages'));
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

    public function showTicketPackage($packageCode)
    {
        session(['packageCode' => $packageCode]);
        $tickets = $this->paginate(DB::table('tickets')
            ->leftJoin('ticket_packages', 'tickets.package_code', '=', 'ticket_packages.package_code')
            ->select('tickets.*', 'ticket_packages.event_name')
            ->where('tickets.package_code', $packageCode));

        // export
        $exportData = DB::table('tickets')
            ->leftJoin('ticket_packages', 'tickets.package_code', '=', 'ticket_packages.package_code')
            ->select('tickets.*', 'ticket_packages.event_name')
            ->where('tickets.package_code', $packageCode)->get();

        $data = [[
            'id',
            'package_code',
            'ticket_code',
            'event_name',
            'usage_status',
            'start_date',
            'end_date',
            'check_in_gate',
        ]];
        foreach ($exportData as $ticket) {
            $data[] = [
                $ticket->id,
                $ticket->package_code,
                "'" . $ticket->ticket_code,
                $ticket->event_name,
                $ticket->usage_status,
                $ticket->start_date,
                $ticket->end_date,
                $ticket->check_in_gate,
            ];
        }
        session(['exportData' => $data]);

        $distinctUsageStatus = DB::table('tickets')->distinct()->pluck('usage_status');
        $distinctCheckIn = DB::table('tickets')->distinct()->pluck('check_in_gate');

        $ticketPackages = DB::table('ticket_packages')->get();

        return view('ticket-management', compact('tickets', 'distinctUsageStatus', 'distinctCheckIn', 'ticketPackages'));
    }

    public function updateStartDate(Request $request)
    {
        $ticketCode = $request->input('ticket-code');
        $packageCode = $request->input('package-code');
        $startDate = $request->input('start-date');

        // Chuyển đổi start_date sang dạng datetime
        $formattedStartDate = Carbon::createFromFormat('d/m/Y', $startDate)->format('Y-m-d H:i:s');

        DB::table('tickets')
            ->where('ticket_code', $ticketCode)
            ->where('package_code', $packageCode)
            ->update(['start_date' => $formattedStartDate]);

        return back();
    }

    public function filterTicketReconciliationPage(Request $request)
    {
        $eventName = $request->input('select_event');
        $status = $request->input('control-status');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        session(['eventName' => $status]);

        $formattedStartDate = Carbon::createFromFormat('d/m/Y', $startDate)->format('Y-m-d') . ' 00:00:00';
        $formattedEndDate = Carbon::createFromFormat('d/m/Y', $endDate)->format('Y-m-d') . ' 23:59:59';

        $ticketsQuery = DB::table('tickets')
            ->leftJoin('ticket_packages', 'tickets.package_code', '=', 'ticket_packages.package_code')
            ->select('tickets.*', 'ticket_packages.event_name');

        if ($eventName !== 'Tất cả') {
            $ticketsQuery->where('ticket_packages.event_name', '=', $eventName);
        }

        if ($status !== 'Tất cả') {
            $ticketsQuery->where('tickets.reconciliation_status', '=', $status);
        }

        $ticketsQuery->where('tickets.start_date', '>=', $formattedStartDate);
        $ticketsQuery->where('tickets.end_date', '<=', $formattedEndDate);

        // export
        $exportData = $ticketsQuery->get();

        $data = [[
            'id',
            'ticket_code',
            'event_name',
            'start_date',
            'ticket_type',
            'check_in_gate',
            'reconciliation_status	'
        ]];
        foreach ($exportData as $ticket) {
            $data[] = [
                $ticket->id,
                "'" . $ticket->ticket_code,
                $ticket->event_name,
                $ticket->start_date,
                $ticket->ticket_type,
                $ticket->check_in_gate,
                $ticket->reconciliation_status,
            ];
        }
        session(['exportData' => $data]);

        $tickets = $this->paginateReconciliation($ticketsQuery);

        $eventNames = DB::table('ticket_packages')->pluck('event_name')->all();

        return view('ticket-reconciliation', compact('tickets', 'eventNames'));
    }

    public function reconciliationStatus()
    {
        session(['eventName' => 'Đã đối soát']);

        $ticketsQuery = DB::table('tickets')
            ->leftJoin('ticket_packages', 'tickets.package_code', '=', 'ticket_packages.package_code')
            ->select('tickets.*', 'ticket_packages.event_name')->where('tickets.reconciliation_status', '=', 'Đã đối soát');

        // export
        $tickets = $ticketsQuery->get();

        $data = [[
            'id',
            'package_code',
            'ticket_code',
            'ticket_type',
            'usage_status',
            'start_date',
            'end_date',
            'check_in_gate',
            'reconciliation_status',
        ]];
        foreach ($tickets as $ticket) {
            $data[] = [
                $ticket->id,
                $ticket->package_code,
                "'" . $ticket->ticket_code,
                $ticket->ticket_type,
                $ticket->usage_status,
                $ticket->start_date,
                $ticket->end_date,
                $ticket->check_in_gate,
                $ticket->reconciliation_status,
            ];
        }
        session(['exportData' => $data]);

        $tickets = $this->paginateReconciliation($ticketsQuery);

        $eventNames = DB::table('ticket_packages')->pluck('event_name')->all();

        return view('ticket-reconciliation', compact('tickets', 'eventNames'));
    }

    public function addTicketPackage(Request $request)
    {
        // Lấy dữ liệu từ request
        $package_name = $request->input('package-name');
        $start_date = $request->input('start-date');
        $start_time = $request->input('start-time');
        $end_date = $request->input('end-date');
        $end_time = $request->input('end-time');
        $single = $request->input('single');
        $combo = $request->input('combo');
        $price_single = $request->input('price-single');
        $price_combo = $request->input('price-combo');
        $quantity_combo = $request->input('quantity-combo');

        if ($single !== 'on') {
            $price_single = null;
        }
        if ($combo !== 'on') {
            $price_combo = null;
            $quantity_combo = null;
        }
        $status = $request->input('status');

        $package_code = $this->randomTicketPackageCode();

        // Kiểm tra và tạo package code mới nếu trùng lặp
        while (DB::table('ticket_packages')->where('package_code', $package_code)->exists()) {
            $package_code = $this->randomTicketPackageCode();
        }

        $formattedStartDate = Carbon::createFromFormat('d/m/Y', $start_date)->format('Y-m-d') . ' ' . $start_time;
        $formattedEndDate = Carbon::createFromFormat('d/m/Y', $end_date)->format('Y-m-d') . ' ' . $end_time;

        DB::table('ticket_packages')->insert([
            'package_code' => $package_code,
            'package_name' => $package_name,
            'start_date' => $formattedStartDate,
            'end_date' => $formattedEndDate,
            'ticket_price' => $price_single,
            'combo_price_amount' => $price_combo,
            'combo_price_tickets' => $quantity_combo,
            'status' => $status,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return back();
    }

    function updateTicketPackage(Request $request)
    {
        $packageCode = $request->input('package-code');
        $eventName = $request->input('event-name');
        $startDate = $request->input('start-date');
        $startTime = $request->input('start-time');
        $endDate = $request->input('end-date');
        $endTime = $request->input('end-time');
        $ticketPrice = $request->input('price-single');
        $comboPriceAmount = $request->input('price-combo');
        $comboPriceTickets = $request->input('quantity-combo');
        $status = $request->input('status');

        // Tạo giá trị datetime hoàn chỉnh từ start-date và start-time
        $formattedStartDate = Carbon::createFromFormat('d/m/Y', $startDate)->format('Y-m-d') . ' ' . $startTime;
        $formattedEndDate = Carbon::createFromFormat('d/m/Y', $endDate)->format('Y-m-d') . ' ' . $endTime;

        $updateData = [
            'event_name' => $eventName,
            'start_date' => $formattedStartDate,
            'end_date' => $formattedEndDate,
            'status' => $status
        ];

        if ($request->has('single')) {
            $updateData['ticket_price'] = $ticketPrice;
        }

        if ($request->has('combo')) {
            $updateData['combo_price_amount'] = $comboPriceAmount;
            $updateData['combo_price_tickets'] = $comboPriceTickets;
        }

        DB::table('ticket_packages')
            ->where('package_code', $packageCode)
            ->update($updateData);

        return back();
    }

    public function exportCsv()
    {
        $data = session('exportData');

        $filename = 'CMS' . date('YmdHis') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function () use ($data) {
            $file = fopen('php://output', 'w');

            // Add BOM
            fwrite($file, "\xEF\xBB\xBF");

            foreach ($data as $row) {
                fputcsv($file, $row);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    function randomTicketPackageCode()
    {
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $length = 10;
        $ticketCode = '';

        for ($i = 0; $i < $length; $i++) {
            $index = rand(0, strlen($characters) - 1);
            $ticketCode .= $characters[$index];
        }

        return $ticketCode;
    }

    public function paginate($param)
    {
        return $param->paginate(8);
    }

    public function paginateReconciliation($param)
    {
        return $param->paginate(10);
    }
}
