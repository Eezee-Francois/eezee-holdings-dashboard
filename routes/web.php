<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;

use App\Http\Controllers\EezeeBatteries\ClientController;
use App\Http\Controllers\EezeeBatteries\UpliftmentController;

use App\Http\Controllers\EezeeLogistics\TruckController;
use App\Http\Controllers\EezeeLogistics\DriverController;

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
    Route::post('store', [UpliftmentController::class, 'store'])->name('upliftment.store');
    Route::get('{id}', [UpliftmentController::class, 'show']);
});
