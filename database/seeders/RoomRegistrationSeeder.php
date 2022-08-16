<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoomRegistrationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now()->format('Y-m-d');

        DB::table('room_registrations')->insert([
            [
                'purpose' => 'Dạy môn Toán lớp 10A1',
                'date' => $now,
                'teacher_id' => 1,
                'period_start_id' => 1,
                'period_end_id' => 2,
                'amount' => 30,
            ],
            [
                'purpose' => 'Dạy môn Toán lớp 10A2',
                'date' => $now,
                'teacher_id' => 2,
                'period_start_id' => 1,
                'period_end_id' => 3,
                'amount' => 30,
            ],
            [
                'purpose' => 'Dạy môn Toán lớp 10A3',
                'date' => $now,
                'teacher_id' => 3,
                'period_start_id' => 3,
                'period_end_id' => 4,
                'amount' => 35,
            ],
            [
                'purpose' => 'Dạy môn Toán lớp 10A4',
                'date' => $now,
                'teacher_id' => 1,
                'period_start_id' => 3,
                'period_end_id' => 5,
                'amount' => 25,
            ],
            [
                'purpose' => 'Dạy môn Toán lớp 10A5',
                'date' => $now,
                'teacher_id' => 2,
                'period_start_id' => 4,
                'period_end_id' => 5,
                'amount' => 24,
            ],
            [
                'purpose' => 'Dạy môn Văn lớp 11A1',
                'date' => $now,
                'teacher_id' => 7,
                'period_start_id' => 1,
                'period_end_id' => 4,
                'amount' => 20,
            ],
            [
                'purpose' => 'Dạy môn Văn lớp 11A2',
                'date' => $now,
                'teacher_id' => 6,
                'period_start_id' => 6,
                'period_end_id' => 9,
                'amount' => 20,
            ],
            [
                'purpose' => 'Dạy môn Vật Lý lớp 11A3',
                'date' => $now,
                'teacher_id' => 14,
                'period_start_id' => 8,
                'period_end_id' => 10,
                'amount' => 20,
            ],
            [
                'purpose' => 'Dạy môn Vật Lý lớp 12A1',
                'date' => $now,
                'teacher_id' => 15,
                'period_start_id' => 7,
                'period_end_id' => 8,
                'amount' => 30,
            ],
            [
                'purpose' => 'Dạy môn Vật Lý lớp 10A4',
                'date' => $now,
                'teacher_id' => 13,
                'period_start_id' => 8,
                'period_end_id' => 9,
                'amount' => 22,
            ],
        ]);
    }
}
