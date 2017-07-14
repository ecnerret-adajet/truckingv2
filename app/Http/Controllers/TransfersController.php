<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Transfer;
use App\Driver;
use App\Hauler;
use App\Truck;
use App\User;
use Alert;


class TransfersController extends Controller
{


    public function create($id)
    {
        $driver = Driver::findOrFail($id);
        $trucks = Truck::pluck('plate_number','plate_number');
        return view('transfers.create', compact('driver','trucks'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function transfers(Request $request, $id)
    {
        $this->validate($request, [
            'to_truck' => 'required',
            'return_date' => 'required|date'
        ],[
            'to_truck.required' => 'Transfer plate number is required',
            'return_date' => 'Date of return field is require'

        ]);


        $driver = Driver::findOrFail($id);
        foreach($driver->trucks as $truck){
            $get_plate = $truck->plate_number;
        }
                    
        $transfer = new Transfer;
        $transfer->user_id = Auth::user()->id;
        $transfer->fill($request->all());
        $transfer->driver()->associate($driver);  
        $transfer->from_truck = $get_plate;
        $transfer->transfer_date = Carbon::now();
        $transfer->save();
       
        alert()->success('You successfully transfer a driver', 'Congratulations');
        return redirect('drivers');
    }

    /**
    *
    *Removes a transfer logs.
    *
    */
    public function removeTransfer(Request $request, $id){
        $transfer = Transfer::findOrFail($id);
        $transfer->availability = 0;
        $transfer->save();

        alert()->success('Successfully Updated','Updated!');
        return redirect('drivers');
    }
  
}
