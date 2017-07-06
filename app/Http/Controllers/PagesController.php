<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Log;
use App\Driver;
use App\Customer;
use App\Truck;
use App\Hauler;
use App\Pickup;
use Carbon\Carbon;

class PagesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function manage()
    {
                
        $haulers = Hauler::all();
        $haulers_week = Hauler::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->get();
        $haulers_month = Hauler::whereMonth('created_at', Carbon::now()->month)->get();
        $haulers_year = Hauler::whereYear('created_at', Carbon::now()->year)->get();

        $drivers = Driver::all();
        $drivers_week = Driver::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->get();
        $drivers_month = Driver::whereMonth('created_at', Carbon::now()->month)->get();
        $drivers_year = Driver::whereYear('created_at', Carbon::now()->year)->get();

        $trucks = Truck::all();
        $trucks_week = Truck::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->get();
        $trucks_month = Truck::whereMonth('created_at', Carbon::now()->month)->get();
        $trucks_year = Truck::whereYear('created_at', Carbon::now()->year)->get();
        
        $pickups = Pickup::all();
        $pickups_week = Pickup::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->get();
        $pickups_month = Pickup::whereMonth('created_at', Carbon::now()->month)->get();
        $pickups_year = Pickup::whereYear('created_at', Carbon::now()->year)->get();
        
        return view('manage', compact(
            'haulers',
            'haulers_week',
            'haulers_month',
            'haulers_year',
            'drivers',
            'drivers_week',
            'drivers_month',
            'drivers_year',
            'trucks',
            'trucks_week',
            'trucks_month',
            'trucks_year',
            'pickups',
            'pickups_week',
            'pickups_month',
            'pickups_year'
        ));
    }

    public function test2()
    {
        $logs = Log::where('CardholderID', '>=', 1)
            ->whereDate('LocalTime', Carbon::now())
            ->orderBy('LocalTime','DESC')->get();
        
        return view('welcome',compact('logs'));
    }
}
