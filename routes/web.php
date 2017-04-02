<?php

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
	if (Auth::guest()){
    return view('auth.login');
    }
    else{
    return view('home');
    }
});

Route::get('/logs', function() {
return App\Log::all();
})->middleware('auth');


Auth::routes();

Route::group(['middleware' => 'auth'], function () {

Route::get('/home', 'LogsController@index');
Route::resource('/drivers','DriversController');
Route::resource('/haulers','HaulersController');
Route::resource('/trucks','TrucksController');


});




