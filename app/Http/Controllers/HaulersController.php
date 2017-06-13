<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Hauler;
use App\Driver;
use App\Log;

class HaulersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $haulers = Hauler::all();
  
        $top_hauler = Hauler::withCount('drivers')
                        ->orderBy('drivers_count','desc')
                        ->take(5)
                        ->get();


        return view('haulers.index', compact('haulers','top_hauler'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('haulers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $hauler = Hauler::create($request->all());
        return redirect('haulers');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Hauler $hauler)
    {
        foreach($hauler->drivers as $driver)
        {
                $logs = Log::where('CardholderID', '=', $driver->cardholder_id)
                ->orderBy('LocalTime','DESC')->get();
        }

  

        return view('haulers.show', compact('hauler','logs'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Hauler $hauler)
    {
        return view('hauler.edit', compact('hauler'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Hauler $hauler)
    {
        $hauler->update($request->all());
        return redirect('haulers');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Hauler $hauler)
    {
        $hauler->delete();
        return redirect('haulers');
    }
}
