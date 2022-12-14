<?php

use App\Http\Controllers\Website\FornecedorController;
use App\Http\Controllers\Website\HomeController;
use App\Http\Controllers\Website\PecaController;
use App\Http\Controllers\Website\ProcurarController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/procurar', [ProcurarController::class, 'index'])->name('procurar.index');

Route::get('/procurar/modelos', [ProcurarController::class, 'modelos'])->name('procurar.modelos');
Route::get('/procurar/montadoras', [ProcurarController::class, 'montadoras'])->name('procurar.montadoras');
Route::get('/procurar/municipios', [ProcurarController::class, 'municipios'])->name('procurar.municipios');

Route::get('/fornecedor/{fornecedor}/{nome}', [FornecedorController::class, 'index'])->name('fornecedores.index');
Route::get('/produto/{fornecedor}/{peca}/{nome}', [PecaController::class, 'index'])->name('pecas.index');
