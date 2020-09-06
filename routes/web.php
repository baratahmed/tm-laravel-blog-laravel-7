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

Route::get('/',[
    'uses' => 'PageController@index',
    'as' => '/'
]);
Route::get('/about',[
    'uses' => 'PageController@about',
    'as' => 'about'
]);
Route::get('/services',[
    'uses' => 'PageController@services',
    'as' => 'services'
]);



Auth::routes();

Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

//Route::resource('posts','PostController');

Route::resource('posts', 'PostController')->names([
    'update' => 'posts.update',

]);