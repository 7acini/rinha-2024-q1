<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\ExtractController;

Route::get('/', function () {
    return view('welcome');
});
Route::post('/clientes/{id}/transacoes', [TransactionController::class, 'store'])
    ->where(['id' => '[0-9]+']);

Route::get('/clientes/{id}/extrato', [ExtractController::class, 'show'])
    ->where(['id' => '[0-9]+']);
