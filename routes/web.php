<?php

use App\Http\Controllers\DisbursementsController;
use App\Http\Controllers\OrderCallbackController;
use App\Http\Controllers\OrdersController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::resource('order', OrdersController::class)->only(['index', 'create', 'store']);
Route::get('/success', [OrdersController::class, 'success'])->name('success');
Route::get('/failure', [OrdersController::class, 'failure'])->name('failure');

Route::resource('disbursement', DisbursementsController::class)->only(['index', 'create', 'store']);