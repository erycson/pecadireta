<?php

use App\Http\Controllers\Painel\AgrupamentoController;
use App\Http\Controllers\Painel\AuditoriaController;
use App\Http\Controllers\Painel\Autenticacao\AuthenticatedSessionController;
use App\Http\Controllers\Painel\CepController;
use App\Http\Controllers\Painel\DashboardController;
use App\Http\Controllers\Painel\FaqController;
use App\Http\Controllers\Painel\FornecedorController;
use App\Http\Controllers\Painel\FornecedorTipoController;
use App\Http\Controllers\Painel\MarcaController;
use App\Http\Controllers\Painel\ModeloController;
use App\Http\Controllers\Painel\MontadoraController;
use App\Http\Controllers\Painel\PecaController;
use App\Http\Controllers\Painel\UsuarioController;
use Illuminate\Routing\ResourceRegistrar;
use Illuminate\Support\Facades\Route;

ResourceRegistrar::setParameters([
    'fornecedores' => 'fornecedor',
    'fornecedores-tipos' => 'fornecedorTipo',
]);

Route::middleware('guest')->group(function () {
    Route::get('entrar', [AuthenticatedSessionController::class, 'create'])
        ->name('entrar');

    Route::post('entrar', [AuthenticatedSessionController::class, 'store']);
});

Route::middleware('auth')->group(function () {
    Route::post('sair', [AuthenticatedSessionController::class, 'destroy'])->name('sair');

    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('usuarios', UsuarioController::class)->except(['show']);
    Route::get('usuarios/fornecedores', [UsuarioController::class, 'fornecedores'])->name('usuarios.fornecedores');

    Route::get('fornecedores/tipos', [FornecedorController::class, 'tipos'])->name('fornecedores.tipos');
    Route::get('fornecedores/ceps', [FornecedorController::class, 'ceps'])->name('fornecedores.ceps');
    Route::get('fornecedores/agrupamentos', [FornecedorController::class, 'agrupamentos'])->name('fornecedores.agrupamentos');
    Route::resource('fornecedores', FornecedorController::class)->except('show');
    Route::resource('fornecedores-tipos', FornecedorTipoController::class)->except('show');
    Route::resource('agrupamentos', AgrupamentoController::class)->except('show');
    Route::resource('auditoria', AuditoriaController::class)->except('show');
    Route::resource('montadoras', MontadoraController::class)->except('show');
    Route::resource('ceps', CepController::class)->except('show');
    Route::resource('faqs', FaqController::class)->except('show');

    Route::get('pecas/fornecedores', [PecaController::class, 'fornecedores'])->name('pecas.fornecedores');
    Route::get('pecas/marcas', [PecaController::class, 'marcas'])->name('pecas.marcas');
    Route::get('pecas/montadoras', [PecaController::class, 'montadoras'])->name('pecas.montadoras');
    Route::get('pecas/modelos', [PecaController::class, 'modelos'])->name('pecas.modelos');
    Route::resource('pecas', PecaController::class)->except('show');
    Route::resource('pecas', PecaController::class)->except('show');

    Route::resource('marcas', MarcaController::class)->except('show');

    Route::get('modelos/montadoras', [ModeloController::class, 'montadoras'])->name('modelos.montadoras');
    Route::resource('modelos', ModeloController::class)->except('show');
});
