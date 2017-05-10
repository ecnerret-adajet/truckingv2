<?php

use Carbon\Carbon;

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

// Route::get('/logs', function() {
// return App\Log::all();
// })->middleware('auth');


Auth::routes();

Route::group(['middleware' => 'auth'], function () {

Route::get('/home', 'LogsController@index');

Route::resource('/drivers','DriversController');
// Route setup for driver temporary transfer
Route::get('/transfers/create/{id}','TransfersController@create');
Route::post('/transfers/{id}','TransfersController@transfers');
Route::post('/transfers/remove/{id}','TransfersController@removeTransfer');

Route::resource('/haulers','HaulersController');

Route::resource('/trucks','TrucksController');
Route::post('/trucks/inactive/{id}', 'TrucksController@changeToInactive');
Route::post('/trucks/active/{id}', 'TrucksController@changeToActive');

Route::resource('users','UsersController');
Route::resource('roles', 'RolesController');

Route::get('settings','ReportsController@index');
Route::get('/feed','ReportsController@feed');



/** START GET ALL JSON DATA **/
Route::get('/getLogs','ReportsController@getLog');
Route::get('/getIns','ReportsController@getIn');
Route::get('/getOuts','ReportsController@getOut');
Route::get('/getDrivers','ReportsController@getDriver');
/** END GET ALL JSON DATA **/


Route::get('/feed-body','ReportsController@feedBody');

// Get JSON File for top driver
Route::get('/getTop', 'DriversController@getTopDriver');
Route::get('/getDrivers', 'DriversController@getDrivers');


//logs route setup
Route::get('/systemlog','logsController@systemLogs');
Route::get('/plant-in','logsController@inPlant');
Route::get('/plant-out','logsController@outPlant');
Route::get('/overtime','logsController@overtime');
Route::get('/report','logsController@getReport');

});




