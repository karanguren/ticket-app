<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

use App\Http\Controllers\PaymentController;

Route::get('/', [PaymentController::class, 'showPaymentOptions'])->name('welcome');

// Route::get('/', function () {
//     return view('welcome');
// })->name('home');

Route::get('/faq', function () {
    return view('faq');
})->name('faq');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

Route::get('/pp', function () {
    return view('emails/tickets');
})->name('tickets');

require __DIR__.'/auth.php';
