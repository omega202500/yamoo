<?php

use App\Http\Controllers\PaymentController;
use App\Http\Controllers\CamPayWebhookController;
use Illuminate\Support\Facades\Route;

Route::get('/acces', [PaymentController::class, 'index'])->name('access.index');
Route::post('/acces/payer', [PaymentController::class, 'pay'])->name('access.pay');
Route::get('/acces/confirmation', [PaymentController::class, 'confirmation'])->name('access.confirmation');
Route::post('/webhooks/campay', [CamPayWebhookController::class, 'handle'])->name('webhooks.campay');