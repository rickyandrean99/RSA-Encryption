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

Route::get('/', function () {
    return view('crypt');
});

Route::post('/encryption', "TestingController@encryption")->name("encryption");
Route::post('/decryption', "TestingController@decryption")->name("decryption");