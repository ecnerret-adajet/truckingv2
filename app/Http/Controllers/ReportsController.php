<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Collection;
use Illuminate\Support\Facades\Route;
use Carbon\Carbon;
use App\Log;
use App\Truck;
use App\Driver;
use App\Hauler;
use App\Customer;
use DB;
use Excel;


class ReportsController extends Controller
{
    
	/**
	**
	** Get Truck Daily Monitoring Report Generate
	**
	**/

	public function getDaily()
	{
		$logs = Log::where('CardholderID', '>=', 1)
        ->whereDate('LocalTime', '>=', Carbon::now())
        ->orderBy('LocalTime','DESC')->get();

		$all_out = Log::where('CardholderID', '>=', 1)
                    ->where('Direction', 2)
                    ->whereDate('LocalTime', Carbon::now())
                    ->orderBy('LocalTime','DESC')->get();

        $all_in = Log::where('CardholderID', '>=', 1)
                    ->where('Direction', 1)
                    ->whereBetween('LocalTime', [Carbon::now()->subDays(1), Carbon::now()])
                    ->orderBy('LocalTime','DESC')->get();

		$all_in_2 = Log::where('CardholderID', '>=', 1)
			->where('Direction', 1)
			->whereDate('LocalTime', Carbon::now())
			->orderBy('LocalTime','DESC')->get();

		$today_result  = $logs->unique('CardholderID');

		return view('reports.daily', compact('today_result','all_in','all_out','all_in_2'));
	}



	public function getExportDaily()
	{

		// excel export
		Excel::create('tracks_export'.Carbon::now()->format('Ymdh'), function($excel) {

            $excel->sheet('Sheet1', function($sheet) {
				$logs = Log::where('CardholderID', '>=', 1)
				->whereDate('LocalTime', '>=', Carbon::now())
				->orderBy('LocalTime','DESC')->get();

				$all_out = Log::where('CardholderID', '>=', 1)
				->where('Direction', 2)
				->whereDate('LocalTime', Carbon::now())
				->orderBy('LocalTime','DESC')->get();

    		    $all_in = Log::where('CardholderID', '>=', 1)
				->where('Direction', 1)
				->whereBetween('LocalTime', [Carbon::now()->subDays(1), Carbon::now()])
				->orderBy('LocalTime','DESC')->get();

				$today_result  = $logs->unique('CardholderID');

                $arr =array();
                foreach($today_result as $today) {
                    foreach($today->drivers as $driver){
						foreach($driver->trucks as $truck){
							foreach($driver->haulers as $hauler){
								foreach($all_in->where('CardholderID', '==', $today->CardholderID)->take(1) as $in){
									foreach($all_out->where('CardholderID', '==', $today->CardholderID)->take(1) as $out){
								$data =  array(
								$driver->name, 
								$truck->plate_number, 
								$hauler->name, 
								$in->localtime == '' ? 'NO IN' : date('Y-m-d h:i:s A', strtotime($in->LocalTime)), 
								$out->localtime == '' ? 'NO OUT' : date('Y-m-d h:i:s A', strtotime($out->LocalTime)), 
								$in->LocalTime->diffInHours($out->LocalTime)
								);
								array_push($arr, $data);
									}
								}
                    		}
						}
					}	
                    
                }

                //set the titles
                $sheet->fromArray($arr,null,'A1',false,false)
                        ->setBorder('A1:F'.$logs->count(),'thin')
                        ->prependRow(array(
                        'DRIVER NAME', 'PLATE NUMBER', 'OPERATOR', 'TIME IN', 'TIME OUT',
                        'TIME DIFFIRENCE'));
                $sheet->cells('A1:F1', function($cells) {
                         $cells->setBackground('#f1c40f'); 
                });

            });

        })->download('xlsx');
		
	}




	public function generateDaily(Request $request)
	{
		$this->validate($request, [
			'start_date' => 'required'
		]);

		$start_date = $request->get('start_date');

		$logs = Log::where('CardholderID', '>=', 1)
        ->whereDate('LocalTime', '>=', Carbon::parse($start_date))
        ->orderBy('LocalTime','DESC')->get();

		$all_out = Log::where('CardholderID', '>=', 1)
                    ->where('Direction', 2)
                    ->whereDate('LocalTime', Carbon::parse($start_date))
                    ->orderBy('LocalTime','DESC')->get();

        $all_in = Log::where('CardholderID', '>=', 1)
                    ->where('Direction', 1)
                    ->whereBetween('LocalTime', [Carbon::parse($start_date)->subDays(1), Carbon::parse($start_date)])
                    ->orderBy('LocalTime','DESC')->get();

		$all_in_2 = Log::where('CardholderID', '>=', 1)
			->where('Direction', 1)
			->whereDate('LocalTime', Carbon::now())
			->orderBy('LocalTime','DESC')->get();

			
		$today_result  = $logs->unique('CardholderID');

		return view('reports.daily', compact('today_result','all_in','all_out','all_in_2'));

	}

	public function feedBody(){

        $logs = Log::where('CardholderID', '>=', 1)
        ->whereDate('LocalTime', '>=', Carbon::now())
        ->orderBy('LocalTime','DESC')->get();


        $all_out = Log::where('CardholderID', '>=', 1)
                    ->where('Direction', 2)
                    ->whereDate('LocalTime', Carbon::now())
                    ->orderBy('LocalTime','DESC')->get();

        $all_in = Log::where('CardholderID', '>=', 1)
                    ->where('Direction', 1)
                    ->whereBetween('LocalTime', [Carbon::now()->subDays(1), Carbon::now()])
                    ->orderBy('LocalTime','DESC')->get();

		$all_in_2 = Log::where('CardholderID', '>=', 1)
			->where('Direction', 1)
			->whereDate('LocalTime', Carbon::now())
			->orderBy('LocalTime','DESC')->get();

		$today_result = $logs->unique('CardholderID');

		return view('feed-body', compact('logs','today_result',
		'all_out','all_in','all_in_2'));
	}


	public function feed(){

			return view('feed');

	}


	/***
	*
	* GET ALL JSON RESULTS FROM DATABASE
	*
	*/


	public function getLog(){

		$logs = Log::with('drivers')
        ->where('CardholderID', '>=', 1)
        ->whereDate('LocalTime', '>=', Carbon::now())
        ->orderBy('LocalTime','DESC')->get();

		$today_result = $logs->unique('CardholderID');

		return \Response::json($today_result);

	}

	public function getIn(){

		$all_in = Log::where('CardholderID', '>=', 1)
                    ->where('Direction', 1)
                    ->whereBetween('LocalTime', [Carbon::now()->subDays(1), Carbon::now()])
                    ->orderBy('LocalTime','DESC')
					->get();

		return \Response::json($all_in);

	}

	public function getOut(){
		$all_out = Log::where('CardholderID', '>=', 1)
			->where('Direction', 2)
			->whereDate('LocalTime', Carbon::now())
			->orderBy('LocalTime','DESC')->get();

		return \Response::json($all_out);
	}

	public function getDriver(){
		$drivers = Driver::with('log','trucks','haulers')
			->get();
		
		return \Response::json($drivers);
	}

	public function getSummary(){
		$haulers = Hauler::pluck('name','id');
		$count_days = 0;

		 $logs = Log::where('CardholderID', '>=', 1)
        ->whereDate('LocalTime', '>=', Carbon::now())
        ->orderBy('LocalTime','DESC')->get();

         $today_result = $logs->unique('CardholderID');

		return view('reports.index', compact('haulers',
			'today_result','logs','start_date','end_date','count_days'));
	}

	public function generateReport(Request $request){

		$this->validate($request, [
			'start_date' => 'required',
			'end_date' => 'required',
			'hauler_list' => 'required',
		]);

		$start_date = $request->get('start_date');
		$end_date = $request->get('end_date');
		$hauler_list = $request->input('hauler_list');
		$count_days = Carbon::parse($start_date)->diffInDays(Carbon::parse($end_date));
	

		$logs = Log::where('CardholderID', '>=', 1)
		->whereBetween('LocalTime', [Carbon::parse($start_date), Carbon::parse($end_date)])
	    ->orderBy('LocalTime','ASC')
	    ->with(['drivers.haulers' => function($q) use ($hauler_list){
	   		$q->where('id', $hauler_list);
	    }])->get();

		$today_result = $logs->unique('CardholderID');

	    
	    $haulers = Hauler::pluck('name','id');

   		$trips = Log::whereDate('LocalTime', '>=' ,$start_date)
	    ->whereDate('LocalTime', '<=', $end_date)
	    ->orderBy('LocalTime','ASC')
	    ->get();

	   
	 
	    $between = ( Carbon::parse($start_date)->diffInDays(Carbon::parse($end_date)) == 0 ? 1 : Carbon::parse($start_date)->diffInDays(Carbon::parse($end_date))  );
	    $col_count = $between + 1;
	    $index =0;

		if($count_days <= 7){

			return view('reports.index', compact('start_date',
	    	'end_date',
	    	'count_days',
	    	'hauler_list',
	    	'value',
	    	'index',
	    	'between',
	    	'col_count',
	    	'trips',
	    	'logs',
	    	'haulers',
	    	'boom',
	    	'today_result'));

		} else {

			return redirect('summary')->with('status', 'Please select a date range not more than 7 days, retry again');
		
		}



	}



}
