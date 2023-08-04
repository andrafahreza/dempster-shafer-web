<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\DataController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group([
    "middlewere" => ["api"],
    "namespace" => "API",
], function () {
    Route::prefix("gejala")->group(function () {
        Route::get('data-gejala', [DataController::class, 'gejala']);
    });
});
