<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dateTime = Carbon::now()->format('Y-m-d H:i:s');
        
        DB::table('admins')->insert([
            [
                'username' => 'AD0001',
                'name' => 'Nguyễn Trung Hậu',
                'password' => Hash::make('12345678'),
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
        ]);
        
    }
}
