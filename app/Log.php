<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Log extends Model
{
    protected $connection = "sqlsrv_three";
    protected $table = "AccessLog2";

    protected $dates = ['LocalTime'];

    public function cardholders()
    {
    	return $this->hasMany('App\Cardholder','CardholderID','CardholderID');
    }

    public function drivers()
    {
    	return $this->hasMany('App\Driver','cardholder_id','CardholderID');
    }

    public function customers()
    {
        return $this->hasMany('App\Customer','log_ID','LogID');
    }

    public function monitors()
    {
        return $this->hasMany('App\Monitor','log_ID','LogID');
    }

    public function getLocalTimeAttribute($date){
        return Carbon::parse($date);
    }

    public function scopeMatch($query, $current)
    {
        return $query->where('CardholderID', '>=', 1)
                     ->where('LogID', '<=', $current)
                     ->where('LogID', '>=', $current-5)
                     ->orderBy('LogID','DESC');
    }


   
}
