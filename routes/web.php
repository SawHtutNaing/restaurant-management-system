<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Livewire\InventoryManagement;
use App\Livewire\MealManagement;
use Illuminate\Support\Facades\Route;
use App\Livewire\UserManagement;
use App\Livewire\CategoryManagement;
use App\Livewire\UserOrdersAndReservations;

use App\Livewire\OrderManagement;
use App\Livewire\ReservationManager;

Route::get('/', [DashboardController::class, 'index'])->name('home');
Route::middleware('auth')->post('/orders', [DashboardController::class, 'storeOrder'])->name('orders.store');
Route::middleware('auth')->post('/reservation', [DashboardController::class, 'storeReservation'])->name('reservation');
Route::middleware('auth')->get('/my-record',UserOrdersAndReservations::class)->name('my_record');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/inventory', InventoryManagement::class)->name('inventory');
    Route::get('/users', UserManagement::class)->name('users');
    Route::get('/categories', CategoryManagement::class)->name('categories');
    Route::get('/orders', OrderManagement::class)->name('orders');
    Route::get('/reservation-manager', ReservationManager::class)->name('reservations');


});

Route::middleware(['auth'])->group(function () {
    Route::get('/meals', MealManagement::class)->name('meals');
});


Route::get('/download-menu', [App\Http\Controllers\DashboardController::class, 'downloadMenu'])->name('download.menu');

require __DIR__.'/auth.php';
