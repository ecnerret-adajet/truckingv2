<?php

use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('statuses')->insert([
        	array('code' => 'RP', 'status' => 'Running - inPlant/Loading'),
        	array('code' => 'RT', 'status' => 'Running - Intransit'),
        	array('code' => 'RC', 'status' => 'Running - At Customer'),
        	array('code' => 'RH', 'status' => 'Running - InPlant Hustling'),
        	array('code' => 'DW', 'status' => 'Down Unit Repair'),
        	array('code' => 'ND', 'status' => 'No Driver')
         ]);
    }
}
