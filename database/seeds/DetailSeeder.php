<?php

use Illuminate\Database\Seeder;

class DetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
          DB::table('details')->insert([
        	array('code' => '00', 'remarks' => '(Zero) Unit No Assignment'),
        	array('code' => 'OK', 'remarks' => 'Within Normal Operations'),
        	array('code' => 'OA', 'remarks' => 'Down - Breakdown / Under Repair'),
        	array('code' => 'OB', 'remarks' => 'Down - Impounded'),
        	array('code' => 'OD', 'remarks' => 'No driver'),
        	array('code' => 'OE', 'remarks' => 'Truck - No Unloaders (Waiting)'),
        	array('code' => 'OF', 'remarks' => 'Truck - No Budget (Waiting)'),
        	array('code' => 'OG', 'remarks' => 'In-Plant Stock Unavailability'),
        	array('code' => 'OH', 'remarks' => 'In-Plant Plant Shutdown'),
        	array('code' => 'OI', 'remarks' => 'In-Plant Truck Scale Breakdown'),
        	array('code' => 'OJ', 'remarks' => 'In-Plant SAP / Internet Unavailable'),
        	array('code' => 'OL', 'remarks' => 'Customer Long Queue'),
        	array('code' => 'OM', 'remarks' => 'Customer Long Queue Truck Scale'),
        	array('code' => 'ON', 'remarks' => 'Customer Diversions'),
        	array('code' => 'OO', 'remarks' => 'Customer Escort / Concerns'),
        	array('code' => 'OP', 'remarks' => 'Customer No Unloaders')
     	  ]);
    }
}
