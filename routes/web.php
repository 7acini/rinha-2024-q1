<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::post('/clientes/{id}/transacoes', [TransactionController::class, 'store'])
    ->where(['id' => '[0-9]+']);

Route::get('/clientes/{id}/extrato', [ExtractController::class, 'show'])
    ->where(['id' => '[0-9]+']);
