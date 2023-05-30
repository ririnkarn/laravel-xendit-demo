<?php

use App\Http\Controllers\Api\XenditController;
use App\Http\Controllers\DisbursementsController;
use App\Http\Controllers\OrderCallbackController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/xendit/balance', [XenditController::class, 'getBalance']);
Route::get('/xendit/transactions', [XenditController::class, 'getTransactions']);
Route::get('/xendit/transactions/{id}', [XenditController::class, 'showTransactions']);
Route::get('/xendit/va', [XenditController::class, 'getVAList']);
Route::post('/xendit/va', [XenditController::class, 'createVA']);
Route::post('/order/callback', OrderCallbackController::class);
Route::post('/disbursement/callback', [DisbursementsController::class, 'callback']);