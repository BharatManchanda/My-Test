<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthenticatedController;
use App\Http\Controllers\LeadController;

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
    return view('index');
});

Route::prefix('/')->name('auth.')->group(function () {
    Route::get('/register', [AuthenticatedController::class, 'showRegisterForm'])->name('show.register.form');
    Route::get('/login', [AuthenticatedController::class, 'showLoginForm'])->name('show.login.form');
    Route::post('/register', [AuthenticatedController::class, 'register'])->name('register');
    Route::post('/login', [AuthenticatedController::class, 'login'])->name('login');
    Route::post('/logout', [AuthenticatedController::class, 'logout'])->name('logout');
});

Route::prefix('/')->middleware('auth')->group(function () {
    
    Route::prefix('/lead')->name('leads.')->group(function () {
        Route::get('/', [LeadController::class, 'index'])->name('index');
        Route::get('/create', [LeadController::class, 'showCreateOrUpdate'])->name('show.create.form');
        Route::get('/update/{id}', [LeadController::class, 'showCreateOrUpdate'])->name('show.update.form');
        Route::post('/create', [LeadController::class, 'create'])->name('create');
        Route::post('/update', [LeadController::class, 'update'])->name('update');
        Route::post('/delete', [LeadController::class, 'destroy'])->name('destroy');
    });
});