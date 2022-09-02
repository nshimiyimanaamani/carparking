<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\parkedcarController;
use App\Http\Controllers\ParkingplaceController;
use App\Http\Controllers\Usecontroller;
use App\Http\Controllers\vehiclesController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::post('/signinIn', [LoginController::class, 'login'])->name('signingIn');

Auth::routes();
Route::get('parking/show', [ParkingplaceController::class, 'index']);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix' => 'admin',  'middleware' => ['auth', 'admin'], 'as' => 'admin.'], function () {
    Route::get('/', [AdminController::class, 'index']);
    // Route::resource('users','Usecontroller');
    Route::post('users/create', [Usecontroller::class, 'create']);
    Route::get('users/', [Usecontroller::class, 'show']);
    Route::get('vehicles/show', [vehiclesController::class, 'show']);
    Route::get('vehicles/', [vehiclesController::class, 'index']);
    Route::post('vehicles/create', [vehiclesController::class, 'create'])->name("createVehicle");
    Route::get('parking/', [ParkingplaceController::class, 'index']);
    Route::get('parking/create', [ParkingplaceController::class, 'show']);
    Route::post('parking/creates', [ParkingplaceController::class, 'create']);
    Route::get('parking/slots/{id}', [ParkingplaceController::class, 'showslots']);
    Route::post('parking/slots/create/{id}', [ParkingplaceController::class, 'slotscreate']);
    Route::get('parking/slots/show/{id}', [ParkingplaceController::class, 'showslotsData']);
    Route::get('parkedCar/', [parkedcarController::class, 'index']);
    Route::post('parkedCar/create', [parkedcarController::class, 'create']);
    Route::get('parkedCar/parkedVehicles', [parkedcarController::class, 'show']);
    Route::get('parkedCar/checkout/{recordId}/{vehicleId}', [parkedcarController::class, 'checkout']);
});
