<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SchoolYearSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('school_years')->insert([
            [
                'name' => '2020 - 2021',
                'start_time' => '2020-08-01',
                'end_time' => '2021-05-31',
                'status' => 0,
            ],
            [
                'name' => '2021 - 2022',
                'start_time' => '2021-08-01',
                'end_time' => '2022-05-31',
                'status' => 0,
            ],
            [
                'name' => '2022 - 2023',
                'start_time' => '2022-08-01',
                'end_time' => '2023-05-31',
                'status' => 1,
            ],
        ]);
    }
}
