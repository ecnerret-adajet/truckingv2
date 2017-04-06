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
use DB;

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
                    ->orderBy('LocalTime','DESC')->get();

        $top_driver = Log::select('CardholderID', \DB::raw('count(*) as total'))
            ->where('CardholderID', '>=', 1)->whereYear('LocalTime', '=', 2017)
            ->groupBy('CardholderID')
            ->orderBy('total', 'desc')
            ->take(5)
            ->get();

        // $driver_trip = Log::select('CardholderID', \DB::raw('count(*) as total'))
        //     ->where('CardholderID', '>=', 1)->whereYear('LocalTime', '=', 2017)
        //     ->groupBy('CardholderID')
        //     ->orderBy('total', 'desc')
        //     ->take(5)
        //     ->get();



        return view('drivers.index', compact('drivers','logs','top_log','top_drivers','top_driver'));

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
                'avatar' => 'required',
                'name' => 'required',
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
                    ->orderBy('LocalTime','DESC')->get();  
        $unique_log = $logs->groupBy('LocalTime');

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
                'avatar' => 'required',
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
