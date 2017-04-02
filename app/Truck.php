<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Truck extends Model
{
    protected $connection = "sqlsrv";
    protected $fillable = [
    	'plate_number',
    	'vehicle_type',
    	'capacity',
    	'origin',
    	'availability'
    ];

    public function drivers()
    {
    	return $this->belongsToMany(Driver::class);
    }

    
}
