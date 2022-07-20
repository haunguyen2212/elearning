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
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'name' => '10C2',
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'name' => '10C3',
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
        ]);
    }
}
