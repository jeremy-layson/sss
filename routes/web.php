<?php

use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use App\Livewire\Works\Create;
use App\Livewire\Works\Edit;
use App\Livewire\Works\Index;
use App\Livewire\Works\Random;
use App\Livewire\Works\Show;
use App\Livewire\Admin\Works as AdminWorks;
use Illuminate\Support\Facades\Route;

Route::get('/', Random::class)->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'admin'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    // Settings routes
    Route::redirect('settings', 'settings/profile');
    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
    
    // Works routes
    Route::get('works', Index::class)->name('works.index');
    Route::get('works/create', Create::class)->name('works.create');
    Route::get('works/{work}/edit', Edit::class)->name('works.edit');
    Route::get('works/{work}', Show::class)->name('works.show');
    Route::get('read', Random::class)->name('works.random');
    
    // Admin routes
    Route::middleware(['admin'])->group(function () {
        Route::get('admin/works', AdminWorks::class)->name('admin.works');
    });
});

require __DIR__.'/auth.php';
