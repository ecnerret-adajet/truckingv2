<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\User;
use App\Log;
use App\Card;
use App\Cardholder;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Driver;
use App\Truck;
use App\Hauler;
use DB;

class LogsController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
    }

    public function index()
    {
    	$logs = Log::where('CardholderID', '>=', 1)
                    ->whereDate('LocalTime', Carbon::now())
                    ->orderBy('LocalTime','DESC')->get();

        $all_out = Log::where('CardholderID', '>=', 1)
                    ->where('Direction', '!=', 1)
                    ->whereDate('LocalTime', Carbon::now())
                    ->orderBy('LocalTime','DESC')->get();

        $all_in = Log::where('CardholderID', '>=', 1)
                    ->where('Direction', 1)
                    ->whereDate('LocalTime', Carbon::now())
                    ->orderBy('LocalTime','DESC')->get();

        $today_log = $logs->unique('CardholderID');



        $cardholders = Cardholder::with('card')->where('CardholderID', '>=', 1)->get();
    	$cards = Card::all();

        $drivers = Driver::all();
        $trucks = Truck::all();
        $base_time = Carbon::now();


        return view('home', compact('logs',
        'cardholders','cards','drivers','trucks','today_log','all_out','all_in','base_time'));
    }

}
