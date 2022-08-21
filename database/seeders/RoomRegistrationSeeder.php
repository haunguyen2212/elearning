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
        $dateTime = Carbon::now()->format('Y-m-d H:i:s');

        DB::table('room_registrations')->insert([
            [
                'purpose' => 'Dạy môn Toán lớp 10A1',
                'date' => $now,
                'teacher_id' => 1,
                'start_time' => '07:00:00',
                'end_time' => '08:30:00',
                'amount' => 30,
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'purpose' => 'Dạy môn Toán lớp 10A2',
                'date' => $now,
                'teacher_id' => 2,
                'start_time' => '07:00:00',
                'end_time' => '09:35:00',
                'amount' => 30,
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'purpose' => 'Dạy môn Toán lớp 10A3',
                'date' => $now,
                'teacher_id' => 3,
                'start_time' => '09:35:00',
                'end_time' => '10:50:00',
                'amount' => 35,
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'purpose' => 'Dạy môn Toán lớp 10A4',
                'date' => $now,
                'teacher_id' => 1,
                'start_time' => '09:35:00',
                'end_time' => '11:30:00',
                'amount' => 25,
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'purpose' => 'Dạy môn Toán lớp 10A5',
                'date' => $now,
                'teacher_id' => 2,
                'start_time' => '10:30:00',
                'end_time' => '11:30:00',
                'amount' => 24,
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'purpose' => 'Dạy môn Văn lớp 11A1',
                'date' => $now,
                'teacher_id' => 7,
                'start_time' => '07:00:00',
                'end_time' => '10:30:00',
                'amount' => 20,
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'purpose' => 'Dạy môn Văn lớp 11A2',
                'date' => $now,
                'teacher_id' => 6,
                'start_time' => '12:00:00',
                'end_time' => '16:00:00',
                'amount' => 20,
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'purpose' => 'Dạy môn Vật Lý lớp 11A3',
                'date' => $now,
                'teacher_id' => 14,
                'start_time' => '15:50:00',
                'end_time' => '16:40:00',
                'amount' => 20,
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'purpose' => 'Dạy môn Vật Lý lớp 12A1',
                'date' => $now,
                'teacher_id' => 15,
                'start_time' => '13:15:00',
                'end_time' => '14:50:00',
                'amount' => 30,
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'purpose' => 'Dạy môn Vật Lý lớp 10A4',
                'date' => $now,
                'teacher_id' => 13,
                'start_time' => '15:00:00',
                'end_time' => '15:15:00',
                'amount' => 22,
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
        ]);
    }
}
