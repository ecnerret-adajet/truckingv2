<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Transfer extends Model
{
    protected $fillable = [
    	'remarks',
    	'expired_date',
    	'transfer_date'
    ];

    protected $dates = [
    	'expired_date',
    	'transfer_date'
    ];

    public function driver()
    {
    	return $this->belongsTo('App\Driver');
    }

    /**
     * Setup date for Expired Date
     */

    public function setExpiredDateAttribute($date)
    {
    	$this->attributes['expired_date'] = Carbon::parse($date);
    }

    public function getExpiredDateAttribute($date)
    {
    	return Carbon::parse($date);
    }

    /**
     * Set date for transfer date
     */
    public function setTransferDateAttribute($date)
    {
    	$this->attributes['transfer_date'] = Carbon::parse($date);
    }

    public function getTransferDateAttribute($date)
    {
    	return Carbon::parse($date);
    }
}
