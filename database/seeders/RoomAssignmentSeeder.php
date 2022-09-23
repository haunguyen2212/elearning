<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoomAssignmentSeeder extends Seeder
{
    
    public function run()
    {
        $dateTime = Carbon::now()->format('Y-m-d H:i:s');

        DB::table('room_assignments')->insert([
            [
                'registration_id' => 1,
                'room_id' => 1,
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'registration_id' => 2,
                'room_id' => 4,
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'registration_id' => 3,
                'room_id' => 1,
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'registration_id' => 4,
                'room_id' => 3,
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'registration_id' => 5,
                'room_id' => 1,
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
        ]);
    }
}
