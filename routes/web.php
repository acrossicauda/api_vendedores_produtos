<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;
use App\Http\Controllers\ProdutosDAO;
use App\Http\Controllers\VendedoresDAO;

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

/*
 * API
 */
Route::prefix('api')->group(function() {
    Route::resource('vendedores', 'VendedoresDAO');
});

Route::prefix('api')->group(function() {
    Route::resource('produtos', 'ProdutosDAO');
});

/*
 * pagina Web
 */
Route::prefix('app')->group(function() {
    Route::resource('vendedores', 'VendedoresDAO');
});

Route::prefix('app')->group(function() {
    Route::resource('produtos', 'ProdutosDAO');
});
