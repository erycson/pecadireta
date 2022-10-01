<?php

use App\Http\Controllers\Website\HomeController;
use App\Http\Controllers\Website\ProcurarController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/procurar', [ProcurarController::class, 'index'])->name('procurar');
