<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hauler extends Model
{
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
