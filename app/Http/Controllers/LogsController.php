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
use \Venturecraft\Revisionable\Revision;
use DB;

class LogsController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
    }

    /**
    *
    *Display all system logs
    *
    */
    public function systemLogs()
    {

        $revisions = Revision::all();
        $drivers = Driver::find(54);
        $history = $drivers->revisionHistory;



        return view('logs.index', compact('drivers','history','revisions'));
    }



    /**
    *
    *Displays all basic dashboard figures
    */
    public function index()
    {

        /**
        *
        * Query on the daily monitoring
        *
        */

    	$logs = Log::where('CardholderID', '>=', 1)
                    ->whereDate('LocalTime', Carbon::now())
                    ->orderBy('LocalTime','DESC')->get();

        $all_out = Log::where('CardholderID', '>=', 1)
                    ->where('Direction', 2)
                    ->whereDate('LocalTime',  Carbon::now())
                    ->orderBy('LocalTime','DESC')->get();

        $all_in = Log::where('CardholderID', '>=', 1)
                    ->where('Direction', 1)
                    ->whereBetween('LocalTime', [Carbon::now()->subDays(1), Carbon::now()])
                    ->orderBy('LocalTime','DESC')->get();

        $all_in_2 = Log::where('CardholderID', '>=', 1)
			->where('Direction', 1)
			->whereDate('LocalTime',   Carbon::now())
			->orderBy('LocalTime','DESC')->get();


        $today_log = $logs->unique('CardholderID')->take(3);
        $total_today = $logs->unique('CardholderID');
        $total_in = $all_in_2->unique('CardholderID');


        $cardholders = Cardholder::with('card')->where('CardholderID', '>=', 1)->get();
    	$cards = Card::all();

        $drivers = Driver::all();
        $trucks = Truck::all();
        $base_time = Carbon::now();


        return view('home', compact('logs',
        'cardholders',
        'cards',
        'drivers',
        'trucks',
        'today_log',
        'all_out',
        'all_in',
        'base_time',
        'all_in_2',
        'total_in',
        'total_today'));
        }



        /**
        *
        *Display all In-plant trucks in compound
        *   
        */
        public function inPlant(){

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

        $total_in = $all_in->unique('CardholderID');


            return view('logs.in-plant', compact('logs','all_out',
            'all_in','total_in','gg'));
        }





        public function outPlant(){

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



        $filter = Log::where('CardholderID', '>=', 1)
                    ->whereDate('LocalTime', Carbon::now())
                    ->orderBy('LocalTime','DESC')->get();


        $total_out = $all_in->unique('CardholderID');            

            return view('logs.out-plant', compact('logs','all_out','all_in','total_out','total_today','filter'));
        }


        public function overtime(){

        $logs = Log::where('CardholderID', '>=', 1)
        ->whereDate('LocalTime', '>=', Carbon::now())
        ->orderBy('LocalTime','DESC')->get();


        $all_out = Log::where('CardholderID', '>=', 1)
                    ->where('Direction', 2)
                    ->whereDate('LocalTime', Carbon::now())
                    ->orderBy('LocalTime','DESC')->get();

        $all_in = Log::where('CardholderID', '>=', 1)
                    ->where('Direction', 1)
                    ->whereDate('LocalTime', Carbon::now())
                    ->orderBy('LocalTime','DESC')->get();


          $today_result = $logs->unique('CardholderID');

            return view('logs.overtime', compact('logs','today_result','all_in','all_out'));
        }



        public function getReport(Request $request){

            $this->validate($request, [
                'start_date' => 'required',
                'end_date' => 'required'

            ]);

            $start_date = $request->get('start_date');
            $end_date = $request->get('end_date');

            $logs = Log::where('CardholderID', '>=', 1)
            ->whereDate('LocalTime', '>=' ,$start_date)
            ->whereDate('LocalTime', '<=', $end_date)
            ->orderBy('LocalTime','ASC')
            ->get();

            $all_out = Log::where('CardholderID', '>=', 1)
                        ->where('Direction', '!=', 1)
                        ->whereDate('LocalTime', '>=' ,$start_date)
                        ->whereDate('LocalTime', '<=', $end_date)
                        ->get();

            $all_in = Log::where('CardholderID', '>=', 1)
                        ->where('Direction', 1)
                        ->whereDate('LocalTime', '>=' ,$start_date)
                        ->whereDate('LocalTime', '<=', $end_date)
                        ->get();

            $final_in = '';
            $final_out = '';

                        
             $today_result = $logs->unique('CardholderID');

            return view('logs.overtime', compact('logs',
            'start_date',
            'end_date',
            'all_in',
            'all_out',
            'final_in',
            'final_out',
            'today_result'));

        }








}
