<?php

use App\Models\Room;
use Illuminate\Database\Seeder;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Room::create([
            'name'  => 'Room1',
            'type_id'  => 'free',
            "ward_id" => 1,
       ]);
       Room::create([
        'name'  => 'Room2',
        'type_id'  => 'free',
        "ward_id" => 2,
        ]);
        Room::create([
            'name'  => 'Room3',
            'type_id'  => 'free',
            "ward_id" => 1,
       ]);
       Room::create([
        'name'  => 'Room4',
        'type_id'  => 'free',
        "ward_id" => 2,
        ]);
        Room::create([
            'name'  => 'Room5',
            'type_id'  => 'free',
            "ward_id" => 1,
       ]);
       Room::create([
        'name'  => 'Room6',
        'type_id'  => 'free',
        "ward_id" => 2,
        ]);
        Room::create([
            'name'  => 'Room7',
            'type_id'  => 'free',
            "ward_id" => 1,
       ]);
       Room::create([
        'name'  => 'Room8',
        'type_id'  => 'free',
        "ward_id" => 2,
        ]);
    }
}
