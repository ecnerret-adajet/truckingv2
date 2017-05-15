<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Collection;
use Carbon\Carbon;
use App\Driver;
use App\Cardholder;
use App\Card;
use App\Hauler;
use App\Truck;
use App\Log;
use App\Transfer;
use DB;
use Alert;

class DriversController extends Controller
{

    public function __construct()
    {
         $this->middleware('auth');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $drivers = Driver::all();
        $logs = Log::where('CardholderID', '>=', 1)
                    ->where('Direction', 1)  // all in
                    ->orderBy('LocalTime','DESC')->get();

        $top_driver = Log::select('CardholderID', \DB::raw('count(*) as total'))
            ->where('CardholderID', '>=', 1)->whereYear('LocalTime', '=', 2017)
            ->groupBy('CardholderID')
            ->orderBy('total', 'desc')
            ->take(5)
            ->get();

        $driver_updated = Driver::orderBy('updated_at','desc')->take(3)->get();
        $transfers = Transfer::orderBy('updated_at','desc')->take(3)->get();


        $values = Log::select('CardholderID', \DB::raw('count(*) as value'))
        ->where('CardholderID', '>=', 1)->whereYear('LocalTime', '=', 2017)
        ->groupBy('CardholderID')
        ->orderBy('value', 'desc')
        ->take(5)
        ->pluck('CardholderID');

         $labels = Driver::whereIn('cardholder_id',$values)->pluck('name');

        return view('drivers.index', compact('drivers',
        'values',
        'labels',
        'logs',
        'top_log',
        'top_drivers',
        'top_driver',
        'driver_updated',
        'transfers'));

    }



    /*
    *
    * Get JSON File from top driver trips
    *
    */

    public function getTopDriver(){

        $value = Log::select('CardholderID', \DB::raw('count(*) as value'))
        ->where('CardholderID', '>=', 1)->whereYear('LocalTime', '=', 2017)
        ->groupBy('CardholderID')
        ->orderBy('value', 'desc')
        ->take(5)
        ->get();

         $label = Driver::whereIn('cardholder_id',$value)->pluck('name');

        $top_driver = Log::
        select(DB::raw('CardholderID as label'), DB::raw('count(*) as value'))
        ->where('CardholderID', '>=', 1)->whereYear('LocalTime', '=', Carbon::now()->year)
        ->groupBy('CardholderID')
        ->orderBy('value', 'desc')
        ->take(3)
        ->get();

        $result = $value->where('CardholderID',$label);


        return $result;
 
    }


    /*
    *
    * Get driver JSON Results
    */
    public function getDrivers(){
        $drivers = Driver::with('haulers')->orderBy('created_at', 'desc')->get();
        return $drivers;
    }

    

    public function searchDrivers(Request $request){
        $search = $request->search;
        $drivers = Driver::with('haulers')
                        ->where('name','LIKE',"%$search%")
                        ->get();
        return $drivers;
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cardholders = Cardholder::pluck('Name','CardholderID');
        $haulers = Hauler::pluck('name','id');
        $trucks = Truck::pluck('plate_number','id');
        return view('drivers.create', compact('cardholders','haulers','trucks'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request, [
                // 'avatar' => 'required',
                'name' => 'required|max:255|unique:drivers',
                'driver_number' => 'required|max:255|unique:drivers',
                'cardholder_list' => 'required',
                'hauler_list' => 'required',
                'truck_list' => 'required',
                'phone_number' => 'required',
                
        ]);

        $plate = $request->input('cardholder_list');
        $driver = Auth::user()->drivers()->create($request->all());
        // $driver->avatar = $request->file('avatar')->store('drivers');
        $driver->cardholder()->associate($plate);
        $driver->save();

        
        $driver->haulers()->attach($request->input('hauler_list'));
        $driver->trucks()->attach($request->input('truck_list'));


        alert()->success('Driver successfully added', 'Success Alert!');
        return redirect('drivers');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Driver $driver)
    {
        $logs = Log::where('CardholderID', '=', $driver->cardholder->CardholderID)
                    ->orderBy('LocalTime','DESC')
                    ->get();  

        return view('drivers.show', compact('driver', 'logs','unique_log'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Driver $driver)
    {
        $cardholders = Cardholder::pluck('Name','CardholderID');

        $haulers = Hauler::pluck('name','id');
        $trucks = Truck::pluck('plate_number','id');
        return view('drivers.edit',compact('driver','cardholders','haulers','trucks'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Driver $driver)
    {
        $this->validate($request, [
                'name' => 'required',
                'cardholder_list' => 'required',
                'hauler_list' => 'required',
                'truck_list' => 'required',
                'phone_number' => 'required',

        ]);

        $plate = $request->input('cardholder_list');

        $driver->update($request->all());

        if($request->hasFile('avatar')){
            $driver->avatar = $request->file('avatar')->store('drivers');
        }        

        $driver->cardholder()->associate($plate);
        $driver->save();

        $driver->haulers()->sync( (array) $request->input('hauler_list'));
        $driver->trucks()->sync( (array) $request->input('truck_list'));

        alert()->success('You successfully updated a driver', 'Success Alert!');
        return redirect('drivers');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
