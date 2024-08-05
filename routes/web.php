<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;

use App\Http\Controllers\EezeeHoldings\EezeeBatteries\ClientController;
use App\Http\Controllers\EezeeHoldings\EezeeBatteries\StockCodeController;
use App\Http\Controllers\EezeeHoldings\EezeeBatteries\UpliftmentController;

use App\Http\Controllers\EezeeHoldings\EezeeLogistics\TruckController;
use App\Http\Controllers\EezeeHoldings\EezeeLogistics\DriverController;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::prefix('eezee_batteries/client')->middleware('auth')->group(function () {
    Route::get('index', [ClientController::class, 'index']);
    Route::get('create', [ClientController::class, 'create']);
    Route::post('{id}', [ClientController::class, 'store']);
    Route::get('{id}', [ClientController::class, 'show']);
    Route::put('address/update/{id}', [ClientController::class, 'address_update'])
        ->name('eezee_batteries.client.address.update');
    Route::delete('{id}', [ClientController::class, 'destroy'])
        ->name('client.destroy');
});

Route::prefix('eezee_logistics/truck')->middleware('auth')->group(function () {
    Route::get('index', [TruckController::class, 'index']);
    Route::get('create', [TruckController::class, 'create']);
    Route::post('{id}', [TruckController::class, 'store']);
    Route::get('{id}', [TruckController::class, 'show']);
    // Route::delete('{id}', [ClientController::class, 'destroy'])
    //     ->name('client.destroy');
});

Route::prefix('eezee_logistics/driver')->middleware('auth')->group(function () {
    Route::get('index', [DriverController::class, 'index']);
    Route::get('create', [DriverController::class, 'create']);
    Route::post('{id}', [DriverController::class, 'store']);
    Route::get('{id}', [DriverController::class, 'show']);
    // Route::delete('{id}', [ClientController::class, 'destroy'])
    //     ->name('client.destroy');
});

Route::prefix('eezee_batteries/client/upliftment')->middleware('auth')->group(function () {
    Route::get('index', [UpliftmentController::class, 'index']);
    Route::get('upcomming_index', [UpliftmentController::class, 'upcomming_index']);
    Route::get('client_drop_off_index', [UpliftmentController::class, 'client_drop_off_index']);
    Route::get('completed_index', [UpliftmentController::class, 'completed_index']);
    Route::post('store', [UpliftmentController::class, 'store'])->name('upliftment.store');
    Route::get('{id}', [UpliftmentController::class, 'show']);
});

Route::prefix('eezee_batteries/stock/stock_code')->middleware('auth')->group(function () {
    Route::get('index', [StockCodeController::class, 'index']);
    Route::post('{id}', [StockCodeController::class, 'store']);
    Route::get('{id}', [StockCodeController::class, 'show']);
});
