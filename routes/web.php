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

Route::get('/fetch','ReportsController@fetch');



Route::get('/stream', function() {

		$logs = App\Log::with('drivers')
        ->where('CardholderID', '>=', 1)
        ->whereDate('LocalTime', '>=', Carbon::now())
        ->orderBy('LocalTime','DESC')->get();


        $all_out =  App\Log::where('CardholderID', '>=', 1)
                    ->where('Direction', 2)
                    ->whereDate('LocalTime', Carbon::now())
                    ->orderBy('LocalTime','DESC')->get();

        $all_in = App\Log::where('CardholderID', '>=', 1)
                    ->where('Direction', 1)
                    ->whereDate('LocalTime', Carbon::now()->subDays(1))
                    ->orderBy('LocalTime','DESC')->get();

		$all_in_2 = App\Log::where('CardholderID', '>=', 1)
			->where('Direction', 1)
			->whereDate('LocalTime', Carbon::now())
			->orderBy('LocalTime','DESC')->get();


        $today_result = $logs->unique('CardholderID');

        return $today_result;

});

Route::get('/get-drivers', function() {
     $drivers = App\Driver::with('log','trucks','haulers')->get();
    return $drivers;
});


Route::get('/get-trucks', function() {
    $trucks = App\Truck::with('drivers')->get();
    return $trucks;
});

Route::get('/get-haulers', function() {
    $haulers = App\Hauler::with('drivers')->get();
    return $haulers;
});




//logs route setup
Route::get('/systemlog','logsController@systemLogs');
Route::get('/plant-in','logsController@inPlant');
Route::get('/plant-out','logsController@outPlant');
Route::get('/overtime','logsController@overtime');
Route::get('/report','logsController@getReport');




});




