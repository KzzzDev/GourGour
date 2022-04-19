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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', function () {
    return view('index');
});
// Route::get('signin', function () {
//     return view('user/signin');
// });
// Route::post('/signin', 'App\Http\Controllers\QueryController@post');
// Route::get('/api', 'App\Http\Controllers\APIController@index');
Route::post('/api', 'App\Http\Controllers\APIController@post');
Route::post('/roulette', 'App\Http\Controllers\RouletteController@post');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
