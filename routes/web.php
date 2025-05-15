<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::post('/clientes/{id}/transacoes', [TransacaoController::class, 'store'])
    ->where(['id' => '[0-9]+']);

Route::get('/clientes/{id}/extrato', [ExtratoController::class, 'show'])
    ->where(['id' => '[0-9]+']);
