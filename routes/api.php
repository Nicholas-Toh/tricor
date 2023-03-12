<?php

use App\Http\Controllers\SalesTransactionController;
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

Route::middleware('auth:sanctum,login_id')->group(function () {
    Route::prefix('sales-transactions')->controller(SalesTransactionController::class)->group(function () {
        Route::get('', 'index')->name('api.sales-transaction');
        Route::post('', 'store')->name('api.sales-transaction.store');
    });
});