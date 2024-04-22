<?php

use App\Http\Controllers\ImportController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\ProductController;
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

Route::get('/', [IndexController::class, 'index']);

Route::get('/import', [ImportController::class, 'import']);
Route::post('/import', [ImportController::class, 'fileImport']);

Route::get('/product/{id}', [ProductController::class, 'showProduct'])->where('id', '[0-9]+');

