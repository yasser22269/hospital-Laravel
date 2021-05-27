<?php

use App\Models\Bed;
use Illuminate\Database\Seeder;

class BedSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=1; $i <=8 ; $i++) { 
            for ($j=1; $j <=6 ; $j++) { 
                        Bed::create([
                            'name'  => 'Bed '.$j." -room ".$i,
                            "room_id" => $i,
                    ]);
             } 
        }
    }
}
