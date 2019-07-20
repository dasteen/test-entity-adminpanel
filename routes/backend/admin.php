<?php

use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\TileController;

// All route names are prefixed with 'admin.'.
Route::redirect('/', '/admin/dashboard', 301);
Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::group([
    'prefix' => 'tiles',
    'as' => 'tiles.',
], function () {
    Route::get('', [TileController::class, 'index'])->name('index');
    Route::get('create', [TileController::class, 'create'])->name('create');
    Route::post('store', [TileController::class, 'store'])->name('store');
    Route::get('{tile}/edit', [TileController::class, 'edit'])->name('edit');
    Route::put('{tile}/update', [TileController::class, 'update'])->name('update');
    Route::delete('{tile}/delete', [TileController::class, 'delete'])->name('delete');
});
