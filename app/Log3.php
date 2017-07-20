<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Log3 extends Model
{
    protected $connection = "sqlsrv_three";
    protected $table = "AccessLog3";

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

    public function getLocalTimeAttribute($date)
    {
        return Carbon::parse($date);
    }

    //Scope Queries

    public function scopeMatch($query, $current)
    {
        return $query->where('CardholderID', '>=', 1)
                     ->where('LogID', '<', $current)
                     ->where('LogID', '>=', $current-5)
                     ->orderBy('LogID','DESC');
    }

    public function scopePickupIn($query, $pickup_card, $created_date)
    {
        return $query->where('CardholderID', $pickup_card)
                     ->where('Direction', 1)
                     ->where('LocalTime', '>', Carbon::parse($created_date))
                     ->where('LocalTime', '<=', Carbon::parse($created_date)->addHour())
                     ->take(1);
    }

    public function scopePickupOut($query, $pickup_card, $created_date)
    {
        return $query->where('CardholderID', $pickup_card)
                     ->where('Direction', 2)
                     ->whereDate('LocalTime', $created_date)
                     ->take(1);
    }

    public function scopeCheckTrip($query, $card, $date)
    {
        return $query->where('CardholderID',$card)
					->whereDate('LocalTime' , Carbon::parse($date))
					->orderBy('LocalTime','ASC');
    }

}
