<?php

use App\Http\Controllers\SSOLoginController;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::middleware('guest')->group(function () {
    Route::get('sso/callback', [SSOLoginController::class, 'handle'])->name('sso.callback');

    Volt::route('login', 'auth.login')
        ->name('login');

});

Route::post('logout', App\Livewire\Actions\Logout::class)
    ->name('logout');
