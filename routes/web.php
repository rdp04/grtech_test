<?php

use App\Http\Controllers\CompaniesController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeesController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Mail\NewEmployeeMail;
use App\Models\Employees;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;

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

Route::get('/email', function () {
    Mail::to('rdp0490@gmail.com')->send(new NewEmployeeMail());

    return new NewEmployeeMail();
});

// Route::get('/dashboard', function(){
//     return view('dashboard.index');
// });
// Route::get('/dashboard',[DashboardController::class, 'index']);

Route::get('/login',[LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login',[LoginController::class, 'authenticate']);

Route::post('/logout',[LoginController::class, 'logout']);

Route::get('/register',[RegisterController::class, 'index'])->middleware('guest');
Route::post('/register',[RegisterController::class, 'store']);

Route::get('/dashboard',function(){
    return view('dashboard.index');
})->middleware('auth');

Route::get('/employees',[EmployeesController::class, 'index'])->middleware('auth');
// Route::get('/companies',[CompaniesController::class, 'index']);

Route::resource('/employees',EmployeesController::class)->middleware('auth');
Route::resource('/companies',CompaniesController::class)->middleware('auth');
Route::resource('/dashboard',DashboardController::class);