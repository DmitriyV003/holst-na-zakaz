<?php

use App\Http\Controllers\AngleController;
use App\Http\Controllers\FormApplicationController;
use App\Http\Controllers\FormTypeController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\SizeController;
use App\Http\Controllers\StyleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1')->group(function () {
    Route::post('form-application', [FormApplicationController::class, 'store']);
    Route::post('media', [MediaController::class, 'store']);

    Route::prefix('admin')->group(function () {
        Route::apiResource('form-type', FormTypeController::class)
            ->only(['show', 'store', 'index', 'update', 'destroy']);
        Route::apiResource('form-application', FormApplicationController::class)
            ->only(['index', 'update']);
        Route::apiResource('site', SiteController::class)
            ->only(['show', 'store', 'index', 'update', 'destroy']);
        Route::apiResource('size', SizeController::class)
            ->only(['show', 'store', 'index', 'update', 'destroy']);
        Route::apiResource('angle', AngleController::class)
            ->only(['show', 'store', 'index', 'update', 'destroy']);
        Route::apiResource('style', StyleController::class)
            ->only(['show', 'store', 'index', 'update', 'destroy']);
        Route::apiResource('order', OrderController::class)
            ->only(['show', 'store', 'index', 'update']);
        Route::apiResource('invoice', InvoiceController::class)
            ->only(['show', 'store', 'index']);
        Route::post('order/{order}/credit', [OrderController::class, 'createCreditInvoice']);
    });
});
