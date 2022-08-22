<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('rooms')->insert([
            [
                'name' => 'Phòng 1',
                'capacity' => 20,
            ],
            [
                'name' => 'Phòng 2',
                'capacity' => 40,
            ],
            [
                'name' => 'Phòng 3',
                'capacity' => 30,
            ],
            [
                'name' => 'Phòng 4',
                'capacity' => 25,
            ],
            [
                'name' => 'Phòng 5',
                'capacity' => 50,
            ],
        ]);
    }
}
