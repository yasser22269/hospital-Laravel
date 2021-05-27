<?php

use App\Models\Shift;
use Illuminate\Database\Seeder;

class ShiftSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Shift::create([
            'start_time'  => '00:00:00',
            'end_time'  => '23:59:59',


       ]);
    }
}
