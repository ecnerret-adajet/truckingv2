<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Driver extends Model 
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


	protected $connection = "sqlsrv";
    protected $fillable = [
    	'avatar',
    	'name',
        'driver_number',
    	'phone_number',
    	'substitute',
        'cardholder_id'
    ];

    /**
     * driver model has a user authenticated belongsto relationship
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function cardholder()
    {
        return $this->belongsTo('App\Cardholder','cardholder_id','CardholderID');
    }

    // public function getCardholderListAttribute()
    // {
    //     return $this->cardholder->pluck('CardholderID')->all();
    // }

    public function log()
    {
        return $this->belongsTo('App\Log','cardholder_id','CardholderID');
    }

    /**
     * driver will have a assigned hauler
     */
    public function haulers()
    {
        return $this->belongsToMany('App\Hauler');
    }

    public function getHaulerListAttribute()
    {
        return $this->haulers->pluck('id')->all();
    }

    /**
     * driver wiill assign a truck plate number
     */
    public function trucks()
    {
        return $this->belongsToMany('App\Truck');
    }

    public function getTruckListAttribute()
    {
        return $this->trucks->pluck('id')->all();
    }

    /**
     * Driver transfer history
     */
    public function transfers()
    {
        return $this->hasMany('App\Transfer');
    }

}
