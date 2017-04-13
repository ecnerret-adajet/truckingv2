<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hauler extends Model
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
    	'name',
    	'address',
    	'contact_number',
        'vendor_name'
    ];
    
    public function drivers()
    {
    	return $this->belongsToMany(Driver::class);
    }

}
