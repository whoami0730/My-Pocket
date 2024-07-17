<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentController;

Route::get('/user', function (Request $request) {
    return $request->user();
});

Route::get('sendMailDaily',[PaymentController::class,'sendMailDaily']);

