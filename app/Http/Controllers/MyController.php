<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MyController extends Controller
{
    public function showIndex()
    {
        $lineChart = [];

        $pieChart = array(
            array(
                'title' => 'Gói sự kiện',
            ),
            array(
                'title' => 'Gói gia đình',                
            )
        );

        foreach ($pieChart as &$item) {
            $item['ve'] = [rand(0, 100000), rand(0, 100000)];
        }
        
        unset($item); // Loại bỏ tham chiếu cuối cùng của mảng
        
        return view('index')->with(['lineChart' => $lineChart, 'pieChart' => $pieChart]);
    }

    public function showTicketManagementPage()
    {
        return view('ticket-management');
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
}
