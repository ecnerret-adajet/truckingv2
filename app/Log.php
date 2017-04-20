<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Log extends Model
{
    protected $connection = "sqlsrv_three";
    protected $table = "AccessLog2";

    public function cardholders()
    {
    	return $this->hasMany('App\Cardholder','CardholderID','CardholderID');
    }

    public function drivers()
    {
    	return $this->hasMany('App\Driver','cardholder_id','CardholderID');
    }



    public function getLocalTimeAttribute($date){
        return Carbon::parse($date);
    }
   
}
