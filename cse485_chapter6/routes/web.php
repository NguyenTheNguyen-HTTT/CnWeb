<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\SinhVienController;

Route::get('/', [PageController::class, 'showHomepage']);
Route::get('/about', [PageController::class, 'showHomepage']);
Route::get('/sinhvien', [SinhVienController::class, 'index'])->name('sinhvien.index');
Route::get('/sinhvien/create', [SinhVienController::class, 'create'])->name('sinhvien.create');
Route::post('/sinhvien', [SinhVienController::class, 'store'])->name('sinhvien.store'); 
