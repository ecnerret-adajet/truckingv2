<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
   
}
