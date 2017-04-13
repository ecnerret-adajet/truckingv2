<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Transfer extends Model
{

    use \Venturecraft\Revisionable\RevisionableTrait;

    protected $revisionEnabled = true;
    protected $revisionCleanup = true;
    protected $historyLimit = 500;
    protected $revisionCreationsEnabled = true;

    public static function boot()
    {
        parent::boot();
    }


    protected $fillable = [
    	'from_truck',
    	'to_truck',
    	'remarks',
    	'return_date',
    	'transfer_date'
    ];

    protected $dates = [
    	'return_date',
    	'transfer_date'
    ];

    public function driver()
    {
    	return $this->belongsTo('App\Driver');
    }

    /**
     * Setup date for Expired Date
     */

    public function setReturnDateAttribute($date)
    {
    	$this->attributes['return_date'] = Carbon::parse($date);
    }

    public function getReturnDateAttribute($date)
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
