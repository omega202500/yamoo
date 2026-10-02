<?php

use App\Http\Controllers\PaymentController;
use App\Http\Controllers\FapshiWebhookController;

Route::post('/webhooks/fapshi', [FapshiWebhookController::class, 'handle'])->name('webhooks.fapshi');
Route::get('/acces', [PaymentController::class, 'index'])->name('access.index');
Route::post('/acces/payer', [PaymentController::class, 'pay'])->name('access.pay');
Route::get('/acces/confirmation', [PaymentController::class, 'confirmation'])->name('access.confirmation');