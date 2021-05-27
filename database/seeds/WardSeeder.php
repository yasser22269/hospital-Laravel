<?php

use App\Models\Ward;
use Illuminate\Database\Seeder;

class WardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Ward::create([
            'name'  => 'ward1',
       ]);
       Ward::create([
        'name'  => 'ward2',
        ]);
    }
}
