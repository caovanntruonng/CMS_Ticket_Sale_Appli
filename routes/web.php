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
