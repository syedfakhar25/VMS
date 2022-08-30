<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
/*
Route::get('/', function () {
    return view('admin.dashboard', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});*/

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/main-link', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
});

//all routes
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/', [\App\Http\Controllers\DashboardController::class, 'index']);
    Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');

    //vehicle crud
    Route::resource('vehicle', \App\Http\Controllers\VehicleController::class);
    Route::get('/search_vehicles/{status}', [\App\Http\Controllers\VehicleController::class, 'searchVehicle'])->name('search_vehicles');
    //departments crud
    Route::resource('department', \App\Http\Controllers\DepartmentsController::class);
});
