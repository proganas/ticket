<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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


//admin login
Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('authenticate', [AuthController::class, 'authenticate'])->name('authenticate');


Route::middleware(['auth'])->group(function () {
    // Admin routes
    Route::middleware(['admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('dashboard', [AuthController::class, 'home'])->name('home');
        Route::resource('tickets', TicketController::class);
        Route::resource('projects', ProjectController::class);
        Route::resource('users', UserController::class);
    });

    // Agent routes
    Route::middleware(['agent'])->prefix('agent')->name('agent.')->group(function () {
        Route::get('dashboard', [AuthController::class, 'home'])->name('home');
        Route::get('tickets', [TicketController::class, 'index'])->name('tickets.index');
        Route::get('tickets/{ticket}', [TicketController::class, 'show'])->name('tickets.show');
        Route::get('/tickets/create', [TicketController::class, 'create'])->name('tickets.create');
        Route::post('/tickets', [TicketController::class, 'store'])->name('tickets.store');
        Route::get('/replay/{ticket}', [TicketController::class, 'replay'])->name('tickets.replay');
        Route::post('/save-replay', [TicketController::class, 'save_replay'])->name('tickets.save_replay');
    });

    // User routes
    Route::middleware(['user'])->prefix('user')->name('user.')->group(function () {
        Route::get('dashboard', [AuthController::class, 'home'])->name('home');
        Route::get('tickets', [TicketController::class, 'index'])->name('tickets.index');
        Route::get('tickets/{ticket}', [TicketController::class, 'show'])->name('tickets.show');
        Route::get('/tickets/create', [TicketController::class, 'create'])->name('tickets.create');
        Route::post('/tickets', [TicketController::class, 'store'])->name('tickets.store');
        Route::get('/replay/{ticket}', [TicketController::class, 'replay'])->name('tickets.replay');
        Route::post('/replay', [TicketController::class, 'save_replay'])->name('tickets.save_replay');
    });

    Route::post('logout', [AuthController::class, 'logout'])->name('logout');

});
