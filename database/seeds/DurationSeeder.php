<?php

use Illuminate\Database\Seeder;

class DurationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
     DB::table('durations')->insert([
        	array('days' => '0', 'remarks' => '(Zero) Unit No Assignment'),
        	array('days' => '1', 'remarks' => '0-24H out of LFUG Plants'),
        	array('days' => '2', 'remarks' => '>24H-48H out of LFUG Plants'),
        	array('days' => '3', 'remarks' => '>48H-72H out of LFUG Plants'),
        	array('days' => '4', 'remarks' => '>72H-96H out of LFUG Plants'),
        	array('days' => '5', 'remarks' => '>96H out of LFUG Plants')
      ]);
    }
}
