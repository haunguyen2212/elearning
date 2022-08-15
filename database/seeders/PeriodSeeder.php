<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PeriodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('periods')->insert([
            [
                'name' => 'Tiết 1',
                'start_time' => '07:00:00',
                'end_time' => '07:45:00',
            ],
            [
                'name' => 'Tiết 2',
                'start_time' => '07:50:00',
                'end_time' => '08:35:00',
            ],
            [
                'name' => 'Tiết 3',
                'start_time' => '08:55:00',
                'end_time' => '09:40:00',
            ],
            [
                'name' => 'Tiết 4',
                'start_time' => '09:45:00',
                'end_time' => '10:30:00',
            ],
            [
                'name' => 'Tiết 5',
                'start_time' => '10:40:00',
                'end_time' => '11:25:00',
            ],
            [
                'name' => 'Tiết 6',
                'start_time' => '12:00:00',
                'end_time' => '12:45:00',
            ],
            [
                'name' => 'Tiết 7',
                'start_time' => '12:50:00',
                'end_time' => '13:35:00',
            ],
            [
                'name' => 'Tiết 8',
                'start_time' => '13:55:00',
                'end_time' => '14:40:00',
            ],
            [
                'name' => 'Tiết 9',
                'start_time' => '14:45:00',
                'end_time' => '15:30:00',
            ],
            [
                'name' => 'Tiết 10',
                'start_time' => '15:40:00',
                'end_time' => '16:25:00',
            ],
        ]);
    }
}
