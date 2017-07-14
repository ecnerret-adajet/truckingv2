<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Cardholder;
use App\Pickup;
use App\Log;

class PickupsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $logs = Log::whereNotIn('ControllerID',[1])
            ->where('CardholderID', '>=', 1)
            ->orderBy('LocalTime','DESC')->get();

        $pickups = Pickup::orderBy('created_at','desc')->get();

        $current_pickup = Pickup::select('cardholder_id')->where('availability',1)->get();

        $available_card = Cardholder::whereNotIn('CardholderID', $current_pickup)
                ->where('Name', 'LIKE', '%Pickup%')->with('pickups')->get();

        $cardholders = Cardholder::with('pickups')->where('Name', 'LIKE', '%Pickup%')->count();

        return view('pickups.index', compact('pickups','cardholders','current_pickup','available_card','check_card','logs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pickup_cards = Pickup::select('cardholder_id')->where('availability',1)->get();
    
        $cardholders = Cardholder::whereNotIn('CardholderID', $pickup_cards)
                                ->where('Name', 'LIKE', '%Pickup%')
                                ->pluck('Name','CardholderID');
                                

        return view('pickups.create', compact('cardholders','pickup_cards'));
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
            'cardholder_list' => 'required',
            'plate_number' => 'required',
            'driver_name' => 'required',
            'company' => 'required'
        ],[
            'cardholder_list.required' => 'Pickup card number is required'
        ]);

        $plate = $request->input('cardholder_list');
        $pickup = Auth::user()->pickups()->create($request->all());
        $pickup->cardholder()->associate($plate);
        $pickup->save();

        alert()->success('Pickup has been issued successfully');
        return redirect('pickups');
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
    public function edit(Pickup $pickup)
    {
        $pickup_cards = Pickup::select('cardholder_id')->where('availability',1)->get();
    
        $cardholders = Cardholder::whereNotIn('CardholderID', $pickup_cards)
                                ->where('Name', 'LIKE', '%Pickup%')
                                ->pluck('Name','CardholderID');

        return view('pickups.edit',compact('pickup_cards','cardholders','pickup'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pickup $pickup)
    {   
        $this->validate($request, [
            'cardholder_list' => 'required',
            'plate_number' => 'required',
            'driver_name' => 'required',
            'company' => 'required'
        ],[
            'cardholder_list.required' => 'Pickup card number is required'
        ]);

        $plate = $request->input('cardholder_list');
        $pickup->update($request->all());
        $pickup->cardholder()->associate($plate);
        $pickup->save();

        alert()->success('Pickup has been update successfully');
        return redirect('pickups');

    }

    /**
     *
     *Deactive a pickup RFID
     *
     *
     *
     */
    public function deactive($id)
    {
        $pick = Pickup::findOrFail($id);
        $pick->availability = false;
        $pick->save();

        alert()->success('Pickup successfully deactivated', 'Success Added!');
        return redirect('pickups');
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
