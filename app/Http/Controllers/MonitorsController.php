<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Collection;
use Illuminate\Support\Facades\Route;
use Carbon\Carbon;
use App\Monitor;
use App\Location;
use App\Status;
use App\Duration;
use App\Detail;
use App\Log;

class MonitorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {

        $log = Log::with('drivers')->where('LogID',$id)->get();



        $all_in = Log::where('CardholderID', '>=', 1)
                    ->where('Direction', 1)
                    ->whereBetween('LocalTime', [Carbon::now()->subDays(1), Carbon::now()])
                    ->orderBy('LocalTime','DESC')->get();

        $all_out = Log::where('CardholderID', '>=', 1)
                    ->where('Direction', 2)
                    ->whereDate('LocalTime',  Carbon::now())
                    ->orderBy('LocalTime','DESC')->get();

        $locations = Location::pluck('region','id');
        $statuses = Status::pluck('status','id');
        $durations = Duration::pluck('days','id');
        $details = Detail::pluck('code','id');
        
        return view('monitors.create', compact('locations',
            'log',
            'id',
            'all_out',
            'all_in',
            'statuses',
            'durations',
            'details'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $this->validate($request, [
            'location_list' => 'required',
            'status_list' => 'required',
            'duration_list' => 'required',
            'detail_list' => 'required',
            'odometer' => 'integer'
         ]);


        $monitor = new Monitor;
        $monitor->remarks = $request->input('remarks');
        $monitor->odometer = $request->input('odometer');
        $monitor->log_ID = $id;
        $monitor->user()->associate(Auth::user());
        $monitor->location()->associate($request->input('location_list'));
        $monitor->status()->associate($request->input('status_list'));
        $monitor->duration()->associate($request->input('duration_list'));
        $monitor->detail()->associate($request->input('detail_list'));
        $monitor->save();

       
        alert()->success('Truck status has been successfully updated', 'Success Alert!');
        session_start();
        return redirect($_SESSION["redirect_lnk"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Monitor $monitor, $id)
    {
        $log = Log::with('drivers')->where('LogID',$id)->get();

        $all_out = Log::where('CardholderID', '>=', 1)
                    ->where('Direction', 2)
                    ->whereDate('LocalTime',  Carbon::now())
                    ->orderBy('LocalTime','DESC')->get();
        $all_in = Log::where('CardholderID', '>=', 1)
                    ->where('Direction', 1)
                    ->whereBetween('LocalTime', [Carbon::now()->subDays(1), Carbon::now()])
                    ->orderBy('LocalTime','DESC')->get();

        $locations = Location::pluck('code','id');
        $statuses = Status::pluck('code','id');
        $durations = Duration::pluck('days','id');
        $details = Detail::pluck('code','id');
        
        return view('monitors.edit', compact('locations',
            'log',
            'monitor',
            'id',
            'all_out',
            'all_in',
            'statuses',
            'durations',
            'details'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Monitor $monitor)
    {
         $this->validate($request, [
            'location_list' => 'required',
            'status_list' => 'required',
            'duration_list' => 'required',
            'detail_list' => 'required',
            'odometer' => 'integer'
         ]);

         $monitor->update($request->all());

         $monitor->location()->associate($request->input('location_list'))->save();
        $monitor->status()->associate($request->input('status_list'))->save();
        $monitor->duration()->associate($request->input('duration_list'))->save();
        $monitor->detail()->associate($request->input('detail_list'))->save();

        alert()->success('Truck status has been successfully updated', 'Success Alert!');
        session_start();
        return redirect($_SESSION["redirect_lnk"]);
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
