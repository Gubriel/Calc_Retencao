<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ContratoController;
use App\Http\Controllers\PlanoController;

// Página inicial: formulário para CPF/CNPJ
Route::get('/', [ClienteController::class, 'index'])->name('cliente.form');

// Envia o CPF/CNPJ e busca o cliente
Route::post('/buscar-cliente', [ClienteController::class, 'buscarCliente'])->name('cliente.buscar');

// Consulta contratos do cliente pelo ID
Route::get('/contratos', [ContratoController::class, 'listarContratos'])->name('contratos.listar');

// Consulta dados do contrato pelo ID do contrato
Route::post('/planos', [PlanoController::class, 'detalhesPlano'])->name('cliente.detalhes');
