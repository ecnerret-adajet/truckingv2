<?php

use Illuminate\Database\Seeder;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('locations')->insert([
        	array('code' => 'RNC', 'region' => 'NCR', 'designation' => 'National Capital Region'),
        	array('code' => 'RCA', 'region' => 'CAR', 'designation' => 'Cordillera Admin Region'),
        	array('code' => 'R01', 'region' => 'REGION1', 'designation' => 'Ilocos Region'),
        	array('code' => 'R02', 'region' => 'REGION2', 'designation' => 'Cagayan Valley'),
        	array('code' => 'R03', 'region' => 'REGION3', 'designation' => 'Cantral Luzon'),
        	array('code' => 'R4A', 'region' => 'REGION4A', 'designation' => 'Calabarzon'),
        	array('code' => 'R4B', 'region' => 'REGION4B', 'designation' => 'Mimaropa'),
        	array('code' => 'R05', 'region' => 'REGION5', 'designation' => 'Bicol'),
        	array('code' => 'XXX', 'region' => 'N/A', 'designation' => 'Unit No Assignment')
        ]);
    }
}
