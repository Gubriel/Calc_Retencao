<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ContratoController;
use App\Http\Controllers\PlanoController;

/*
|--------------------------------------------------------------------------
| Rotas protegidas por autenticação
|--------------------------------------------------------------------------
| Somente usuários logados podem acessar essas rotas.
*/
Route::middleware(['auth'])->group(function () {

    Route::get('/', [ClienteController::class, 'index'])->name('cliente.form');

    Route::post('/buscar-cliente', [ClienteController::class, 'buscarCliente'])->name('cliente.buscar');

    // Consulta contratos do cliente pelo ID
    Route::get('/contratos', [ContratoController::class, 'listarContratos'])->name('contratos.listar');

    // Consulta dados do contrato pelo ID do contrato
    Route::post('/planos', [PlanoController::class, 'detalhesPlano'])->name('cliente.detalhes');

    Route::get('/sair', function () {
        Auth::logout();
        return redirect('/login');
    })->name('sair');

});


// Autenticação do Breeze
require __DIR__.'/auth.php';
