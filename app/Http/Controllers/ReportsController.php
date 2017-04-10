<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Collection;
use Carbon\Carbon;
use App\Log;
use App\Truck;
use App\Driver;


class ReportsController extends Controller
{
    
	public function index()
	{
		return view('monitor');
	}


}
