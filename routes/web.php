<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/dashboard', \App\Livewire\UserDashboard::class)->middleware(['auth', 'not-banned'])->name('dashboard');

Route::get('/test', function () {
    return view('test');
})->name('test');

// User Task Routes (Non-Filament)
// Protected with auth, not-banned, and can-take-task middleware
Route::middleware(['auth', 'not-banned', 'can-take-task'])->prefix('user')->name('user.')->group(function () {
    Route::get('/dashboard', \App\Livewire\TaskDashboard::class)->name('dashboard');
    Route::get('/my-tasks', \App\Livewire\MyTasks::class)->name('my-tasks');
    Route::get('/task/{task}/work', \App\Livewire\TaskWorkWizard::class)->name('task.work');
    Route::get('/history', \App\Livewire\TaskHistory::class)->name('history');
});

Route::middleware(['auth', 'not-banned'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');

    // Information Page
    Volt::route('pages/information', 'pages.information')->name('pages.information');

    // Tips & Trick Pages
    Volt::route('pages/panduan-task', 'pages.panduan-task')->name('pages.panduan-task');
    Volt::route('pages/tips-sukses', 'pages.tips-sukses')->name('pages.tips-sukses');
    Volt::route('pages/faq', 'pages.faq')->name('pages.faq');
});

require __DIR__ . '/auth.php';
