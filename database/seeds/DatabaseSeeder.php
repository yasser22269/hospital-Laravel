<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call(ShiftSeeder::class);
         $this->call(AdminSeeder::class);
         $this->call(WardSeeder::class);
         $this->call(RoomSeeder::class);
         $this->call(BedSeeder::class);
    }
}
