<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Collection;
use Carbon\Carbon;
use App\Log;
use App\Truck;
use App\Driver;
use DB;


class ReportsController extends Controller
{
    
	public function index()
	{
		return view('monitor');
	}

	public function feedBody(){

        $logs = Log::where('CardholderID', '>=', 1)
        ->whereDate('LocalTime', '>=', Carbon::now())
        ->orderBy('LocalTime','DESC')->get();


        $all_out = Log::where('CardholderID', '>=', 1)
                    ->where('Direction', 2)
                    ->whereDate('LocalTime', Carbon::now())
                    ->orderBy('LocalTime','DESC')->get();

        $all_in = Log::where('CardholderID', '>=', 1)
                    ->where('Direction', 1)
                    ->whereBetween('LocalTime', [Carbon::now()->subDays(1), Carbon::now()])
                    ->orderBy('LocalTime','DESC')->get();

		$all_in_2 = Log::where('CardholderID', '>=', 1)
			->where('Direction', 1)
			->whereDate('LocalTime', Carbon::now())
			->orderBy('LocalTime','DESC')->get();

		$today_result = $logs->unique('CardholderID');

		return view('feed-body', compact('logs','today_result',
		'all_out','all_in','all_in_2'));
	}


	public function feed(){

			return view('feed');

	}


	/***
	*
	* GET ALL JSON RESULTS FROM DATABASE
	*
	*/


	public function getLog(){

		$logs = Log::with('drivers')
        ->where('CardholderID', '>=', 1)
        ->whereDate('LocalTime', '>=', Carbon::now())
        ->orderBy('LocalTime','DESC')->get();

		$today_result = $logs->unique('CardholderID');

		return \Response::json($today_result);

	}

	public function getIn(){

		$all_in = Log::where('CardholderID', '>=', 1)
                    ->where('Direction', 1)
                    ->whereBetween('LocalTime', [Carbon::now()->subDays(1), Carbon::now()])
                    ->orderBy('LocalTime','DESC')
					->get();

		return \Response::json($all_in);

	}

	public function getOut(){
		$all_out = Log::where('CardholderID', '>=', 1)
			->where('Direction', 2)
			->whereDate('LocalTime', Carbon::now())
			->orderBy('LocalTime','DESC')->get();

		return \Response::json($all_out);
	}

	public function getDriver(){
		$drivers = Driver::with('log','trucks','haulers')
			->get();
		
		return \Response::json($drivers);
	}



}
