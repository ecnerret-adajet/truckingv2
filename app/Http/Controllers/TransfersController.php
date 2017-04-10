<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Collection;
use Carbon\Carbon;
use App\Driver;
use App\Truck;
use App\Hauler;
use Alert;

class TransfersController extends Controller
{


    public function create($id)
    {
        $driver = Driver::findOrFail($id);
        return view('transfers.create', compact('driver'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store($id)
    {
        $driver = Driver::findOrFail($id);
        $transfer = Transfer::create($request->all());
        $transfer->transfer_date = Carbon::now();
        $transfer->driver()->associate($driver);

        alert()->success('You successfully transfer a driver', 'Congratulations');
        return redirect('drivers');
    }

  
}
