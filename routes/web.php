<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ContratoController;
use App\Http\Controllers\PlanoController;


Route::middleware(['auth'])->group(function () {

    Route::get('/', [ClienteController::class, 'index'])->name('cliente.form');
    Route::post('/buscar-cliente', [ClienteController::class, 'buscarCliente'])->name('cliente.buscar');
    Route::get('/contratos', [ContratoController::class, 'listarContratos'])->name('contratos.listar');
    Route::post('/planos', [PlanoController::class, 'detalhesPlano'])->name('cliente.detalhes');

    Route::get('/sair', function () {
        Auth::logout();
        return redirect('/login');
    })->name('sair');

});

// Autenticação do Breeze
require __DIR__.'/auth.php';
