<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Hauler;
use App\Truck;
use Excel;
use Alert;


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
     * Export trucks to excel
     *
     * @return \Excel
     */
     public function exportTrucks()
     {
        $trucks = Truck::all();

        Excel::create('trucks'.Carbon::now()->format('Ymdh'), function($excel) use ($trucks) {

            $excel->sheet('Sheet1', function($sheet) use ($trucks) {

                $arr = array();

                foreach($trucks as $truck) {
                    foreach($truck->drivers as $driver) {
                        foreach($driver->haulers as $hauler) {

                            $data =  array(
                            $truck->plate_number,
                            $truck->vehicle_type,
                            $truck->capacity,
                            $hauler->name,
                            $driver->name
                            );

                            array_push($arr, $data);

                        }
                    }
                }

                //set the titles
                $sheet->fromArray($arr,null,'A1',false,false)
                        ->setBorder('A1:E'.$trucks->count(),'thin')
                        ->prependRow(array(
                        'PLATE NUMBER', 'TRUCK TYPE', 'CAPACITY', 'HAULER', 'DRIVER NAME'));
                $sheet->cells('A1:E1', function($cells) {
                         $cells->setBackground('#f1c40f'); 
                });


            });

        })->download('xlsx');

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
