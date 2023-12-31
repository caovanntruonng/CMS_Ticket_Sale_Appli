<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MyController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Home page
Route::get('/', [MyController::class, 'showIndex'])->name('HomePage');

// Ticket Management Page
Route::get('/ticket-management', [MyController::class, 'showTicketManagementPage'])->name('TicketManagementPage');

// Ticket Reconciliation Page
Route::get('/ticket-reconciliation', [MyController::class, 'showTicketReconciliationPage'])->name('TicketReconciliationPage');

// Event List Page
Route::get('/event-list', [MyController::class, 'showEventListPage'])->name('EventListPage');

// Device Management Page
Route::get('/device-management', [MyController::class, 'showDeviceManagementPage'])->name('DeviceManagementPage');

// Services Page
Route::get('/services', [MyController::class, 'showServicesPage'])->name('ServicesPage');

// Định nghĩa route để xử lý yêu cầu lọc vé và gọi phương thức handleFilterData trong YourController
Route::get('/ticket-management/{package_code}/filter-data', [MyController::class, 'filterTicketManagementPage'])->name('FilterData');

Route::get('/ticket-management/{package_code}', [MyController::class, 'showTicketPackage'])->name('showTicketPackage');

Route::post('/ticket-management/update-start-date', [MyController::class, 'updateStartDate'])->name('updateStartDate');

Route::get('/ticket-reconciliation/filter-data', [MyController::class, 'filterTicketReconciliationPage'])->name('filterTicketReconciliationPage');

Route::get('/ticket-reconciliation/reconciliation-status', [MyController::class, 'reconciliationStatus'])->name('reconciliationStatus');

Route::post('/services/add-ticket-package', [MyController::class, 'addTicketPackage'])->name('addTicketPackage');

Route::post('/services/update-ticket-package', [MyController::class, 'updateTicketPackage'])->name('updateTicketPackage');

Route::get('/exportCsv', [MyController::class, 'exportCSV'])->name('exportCSV');
