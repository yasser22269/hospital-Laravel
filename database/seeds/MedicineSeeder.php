<?php

use App\Models\Medicine;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
class MedicineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        for ($i=1; $i <=10 ; $i++) {
            Medicine::create([
                            'name'  => 'Medicine '.$i,
                            "Unit" => Arr::random(['pills', 'gram']),
                            "Amount" =>  random_int(10,100),
                    ]);

        }
    }
}
