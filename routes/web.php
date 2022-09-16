<?php

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

Route::prefix('painel')->name('painel.')->middleware('web')->group(function () {
    require __DIR__ . '/web.painel.php';
});
// Route::name('website.')->group(function () {
//     require __DIR__ . '/website.php';
// });
