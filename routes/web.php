<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

use App\Livewire\TicketsList;


// Route::get('/', function () {
//     return view('welcome');
// })->name('welcome');

Route::get('/', function () {
    return view('maintenance');
})->name('maintenance');

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
    return view('emails/confirmacion');
})->name('confirmacion');

Route::get('/kk', function () {
    return view('numeros');
});

Route::get('/admin-tickets', function () {
    return view('tickets-admin-page');
})->name('admin.tickets.list');

require __DIR__.'/auth.php';
