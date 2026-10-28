<?php

use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PropertyController as AdminPropertyController;
use App\Http\Controllers\Admin\PropertyMediaController as AdminPropertyMediaController;
use App\Http\Controllers\Admin\SectionController as AdminSectionController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\SocialLinkController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/property/{property}', [HomeController::class, 'show'])->name('property.show');

Route::middleware('auth')->get('/dashboard', function () {
    return auth()->user()->isAdmin()
        ? redirect()->route('admin.dashboard')
        : redirect()->route('home');
})->name('dashboard');

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('properties', AdminPropertyController::class)->except(['show']);
    Route::prefix('properties/{property}')->name('properties.')->group(function () {
        Route::post('media', [AdminPropertyMediaController::class, 'store'])->name('media.store');
        Route::delete('media/{media}', [AdminPropertyMediaController::class, 'destroy'])->name('media.destroy');
        Route::patch('media/{media}/cover', [AdminPropertyMediaController::class, 'cover'])->name('media.cover');
        Route::post('media/reorder', [AdminPropertyMediaController::class, 'reorder'])->name('media.reorder');
    });
    Route::resource('sections', AdminSectionController::class)->except(['show']);
    Route::resource('social-links', SocialLinkController::class)
        ->except(['show'])
        ->parameters(['social-links' => 'socialLink']);
    Route::patch('social-links/{socialLink}/toggle', [SocialLinkController::class, 'toggle'])->name('social-links.toggle');
    Route::post('social-links/{socialLink}/move/{direction}', [SocialLinkController::class, 'move'])
        ->whereIn('direction', ['up', 'down'])
        ->name('social-links.move');
    Route::get('settings', [SettingController::class, 'index'])->name('settings.index');
    Route::post('settings', [SettingController::class, 'update'])->name('settings.update');
    Route::resource('admins', AdminUserController::class)->only(['index', 'create', 'store', 'destroy']);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
