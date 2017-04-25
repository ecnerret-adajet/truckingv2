<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Collection;
use Carbon\Carbon;
use App\Log;
use App\Truck;
use App\Driver;


class ReportsController extends Controller
{
    
	public function index()
	{
		return view('monitor');
	}

	public function feed(){

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

		return view('feed', compact('logs','today_result',
		'all_out','all_in','all_in_2'));
	}


	public function fetch(){

		$logs = Log::where('CardholderID', '>=', 1)
        ->whereDate('LocalTime', '>=', Carbon::now())
        ->orderBy('LocalTime','DESC')->get();

		$drivers = Driver::with('log','trucks','haulers')->get();

		$today_result = $logs->unique('CardholderID');

		return \Response::json($today_result);

	}


}
