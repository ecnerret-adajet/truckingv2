<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Truck extends Model
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
 