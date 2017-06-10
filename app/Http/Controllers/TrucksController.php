<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Truck;
use Carbon\Carbon;
use Alert;
use App\Hauler;


class TrucksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $trucks = Truck::all();
        return view('trucks.index', compact('trucks'));
    }

    /**
    *
    * Get trucks json data
    *
    **/
    public function getTrucks()
    {
        $trucks = Truck::orderBy('created_at','desc')->get();
        return $trucks;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $haulers = Hauler::pluck('name','id');
        return view('trucks.create', compact('haulers'));
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
            'plate_number' => 'required|unique:trucks',
            'hauler_list' => 'required'
        ]);

        $truck = Truck::create($request->all());
        $truck->haulers()->attach($request->input('hauler_list'));


        alert()->success('Truck successfully added', 'Success Alert!');

        return redirect('trucks');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Truck $truck)
    {
        return view('trucks.show',compact('truck'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Truck $truck)
    {
        $haulers = Hauler::pluck('name','id');
        return view('trucks.edit', compact('truck','haulers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Truck $truck)
    {
        
        $this->validate($request, [
            'plate_number' => 'required|unique:trucks',
            'hauler_list' => 'required'
        ]);

        $truck->update($request->all());
        $truck->haulers()->sync( (array) $request->input('hauler_list'));

        alert()->success('Truck successfully added', 'Success Alert!');
        return redirect('trucks');
    }

    /**
     * Change truck availability status
     */
    public function changeToInactive($id)
    {
        $truck = Truck::findOrFail($id);
        $truck->availability = 0;
        $truck->save();

        alert()->success('Truck Availability Update','Success Update');
        return redirect('trucks');
    }

    /**
     * Change truck availability status to active
     */
    public function changeToActive($id)
    {
        $truck = Truck::findOrFail($id);
        $truck->availability = 1;
        $truck->save();

        alert()->success('Truck Availability Update','Success Update');
        return redirect('trucks');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Truck $truck)
    {
        $truck->delete();
        return redirect('trucks');
    }
}
