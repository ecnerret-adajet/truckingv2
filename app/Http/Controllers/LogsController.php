<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Collection;
use \Venturecraft\Revisionable\Revision;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Cardholder;
use Carbon\Carbon;
use App\Customer;
use App\Hauler;
use App\Driver;
use App\Truck;
use App\Card;
use App\User;
use App\Log;
use DB;

class LogsController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
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

        $today_in = Log::where('CardholderID', '>=', 1)
                    ->where('Direction', 1)
                    ->whereDate('LocalTime', Carbon::now())
                    ->orderBy('LocalTime','DESC')
                    ->get();



        $base_time = Carbon::now();         
        $today_log = $logs->unique('CardholderID')->take(35); //35
        // count total in
        $total_in = $today_in->unique('CardholderID');
        // count total trucks with time in and out
        $total_out = $all_in->unique('CardholderID'); 

        $all_drivers = Driver::all();
        $all_trucks = Truck::all();
        $all_haulers = Hauler::all();
           
        return view('home', compact('logs',
        'today_log',
        'all_drivers',
        'all_trucks',
        'all_haulers',
        'url',
        'all_out',
        'all_in_2 ',
        'all_in',
        'total_in',
        'total_out',
        'base_time'));
        }





    /**
    *
    *Display all In-plant trucks in compound
    *   
    */
    public function inPlant(){


        $all_out = Log::where('CardholderID', '>=', 1)
                    ->where('Direction', 2)
                    ->whereDate('LocalTime', Carbon::now())
                    ->orderBy('LocalTime','DESC')->get();


        $all_in = Log::where('CardholderID', '>=', 1)
                    ->where('Direction', 1)
                    ->whereDate('LocalTime', Carbon::now())
                    ->orderBy('LocalTime','DESC')
                    ->get();


        $total_in = $all_in->unique('CardholderID');


        return view('logs.in-plant', compact('all_out',
        'all_in','total_in','test_in'));
    }


    public function outPlant(){

    $all_out = Log::where('CardholderID', '>=', 1)
                ->where('Direction', '!=', 1)
                ->whereDate('LocalTime', Carbon::now())
                ->orderBy('LocalTime','DESC')->get();

    $all_in = Log::where('CardholderID', '>=', 1)
                ->where('Direction', 1)
                ->whereBetween('LocalTime', [Carbon::now()->subDays(1), Carbon::now()])
                ->orderBy('LocalTime','DESC')->get();


    $total_out = $all_in->unique('CardholderID');            

        return view('logs.out-plant', compact('all_out','all_in','total_out','total_today'));
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
                ->whereBetween('LocalTime', [Carbon::now()->subDays(1), Carbon::now()])
                ->orderBy('LocalTime','DESC')->get();

    $all_in_2 = Log::where('CardholderID', '>=', 1)
        ->where('Direction', 1)
        ->whereDate('LocalTime',   Carbon::now())
        ->orderBy('LocalTime','DESC')->get();


        $today_result = $logs->unique('CardholderID');

        return view('logs.overtime', compact('logs','today_result','all_in','all_out','all_in_2'));
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
                ->whereBetween('LocalTime', [$start_date, $end_date])
                ->get();

        $all_in_2 = Log::where('CardholderID', '>=', 1)
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
        'all_in_2',
        'today_result'));

    }


    public function testCustomer(){
        $customers = Customer::with('Log')->get();
        return $customers;
    }

    public function testLogs(){
        

        $logs = Log::with('drivers','customers','drivers.trucks','drivers.haulers')
                ->where('CardholderID', '>=', 1)
                ->whereDate('LocalTime', Carbon::now())
                ->orderBy('LocalTime','DESC')->get();
            $today_log = $logs->unique('CardholderID')->take(15);

            return $today_log;
    }

    public function getTimeIn(){
            $all_in = Log::where('CardholderID', '>=', 1)
                ->where('Direction', 1)
                ->whereBetween('LocalTime', [Carbon::now()->subDays(1), Carbon::now()])
                ->orderBy('LocalTime','DESC')->get();
        return $all_in;
    }








}
