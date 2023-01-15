<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Admin\CellLivewire;
use App\Http\Controllers\ProfileController;
use App\Http\Livewire\Admin\BibleSchoolLivewire;
use App\Http\Livewire\Admin\MemberLivewire;
use App\Http\Livewire\Admin\SectorLivewire;
use App\Http\Livewire\Admin\NeighborhoodLivewire;

Route::get('/', function () {
    return view('welcome');
});

/* Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard'); */

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('/dashboard', 'dashboard')->name('dashboard');
    Route::prefix('admin')->group(function () {
        Route::get('/sectors', SectorLivewire::class)->name('admin.sectors.index');
        Route::get('/neighborhood', NeighborhoodLivewire::class)->name('admin.neighborhood.index');
        Route::get('/cells', CellLivewire::class)->name('admin.cells.index');
        Route::get('/bible-school', BibleSchoolLivewire::class)->name('admin.bible-school.index');
        Route::get('/members', MemberLivewire::class)->name('admin.members.index');
    });
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
