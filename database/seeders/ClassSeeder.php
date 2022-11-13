<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dateTime = Carbon::now()->format('Y-m-d H:i:s');
        
        DB::table('classes')->insert([
            [
                'name' => '10C1',
                'schooL_year_id' => 1,
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'name' => '10C2',
                'schooL_year_id' => 1,
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'name' => '10C1',
                'schooL_year_id' => 2,
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'name' => '10C2',
                'schooL_year_id' => 2,
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'name' => '10C3',
                'schooL_year_id' => 2,
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'name' => '10C1',
                'schooL_year_id' => 3,
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'name' => '10C2',
                'schooL_year_id' => 3,
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'name' => '10C3',
                'schooL_year_id' => 3,
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'name' => '10C4',
                'schooL_year_id' => 3,
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'name' => '10C5',
                'schooL_year_id' => 3,
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'name' => '10C6',
                'schooL_year_id' => 3,
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'name' => '11C1',
                'schooL_year_id' => 3,
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'name' => '11C2',
                'schooL_year_id' => 3,
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'name' => '11C3',
                'schooL_year_id' => 3,
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'name' => '11C4',
                'schooL_year_id' => 3,
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'name' => '11C5',
                'schooL_year_id' => 3,
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'name' => '11C6',
                'schooL_year_id' => 3,
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'name' => '12C1',
                'schooL_year_id' => 3,
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'name' => '12C2',
                'schooL_year_id' => 3,
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'name' => '12C3',
                'schooL_year_id' => 3,
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'name' => '12C4',
                'schooL_year_id' => 3,
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
        ]);
    }
}
