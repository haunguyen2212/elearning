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
        $now = Carbon::now();
        $lastWeek = $now->addDay(7);
        $monday = $lastWeek->startOfWeek()->format('Y-m-d');
        $tuesday = $lastWeek->startOfWeek()->addDays(1)->format('Y-m-d');
        $wednesday = $lastWeek->startOfWeek()->addDays(2)->format('Y-m-d');
        $thursday = $lastWeek->startOfWeek()->addDays(3)->format('Y-m-d');
        $friday = $lastWeek->startOfWeek()->addDays(4)->format('Y-m-d');
        $saturday = $lastWeek->startOfWeek()->addDays(5)->format('Y-m-d');
        $sunday = $lastWeek->endOfWeek()->format('Y-m-d');
        $dateTime = Carbon::now()->format('Y-m-d H:i:s');

        DB::table('room_registrations')->insert([
            [
                'purpose' => 'Dạy môn Toán lớp 10A1',
                'date' => Carbon::now()->startOfWeek()->format('Y-m-d'),
                'teacher_id' => 1,
                'start_time' => '09:00:00',
                'end_time' => '12:00:00',
                'amount' => 20,
                'status' => 1,
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'purpose' => 'Dạy môn Văn lớp 11',
                'date' => Carbon::now()->startOfWeek()->format('Y-m-d'),
                'teacher_id' => 7,
                'start_time' => '07:00:00',
                'end_time' => '10:30:00',
                'amount' => 20,
                'status' => 1,
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'purpose' => 'Họp Tổ Toán',
                'date' => Carbon::now()->startOfWeek()->format('Y-m-d'),
                'teacher_id' => 2,
                'start_time' => '12:00:00',
                'end_time' => '13:00:00',
                'amount' => 10,
                'status' => 1,
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'purpose' => 'Dạy môn Vật Lý lớp 10A4',
                'date' => Carbon::now()->startOfWeek()->addDays(1)->format('Y-m-d'),
                'teacher_id' => 13,
                'start_time' => '8:00:00',
                'end_time' => '9:30:00',
                'amount' => 30,
                'status' => 1,
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'purpose' => 'Họp tổ Vật Lý',
                'date' => Carbon::now()->startOfWeek()->addDays(2)->format('Y-m-d'),
                'teacher_id' => 13,
                'start_time' => '7:00:00',
                'end_time' => '7:30:00',
                'amount' => 10,
                'status' => 1,
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'purpose' => 'Dạy môn Toán lớp 10A1',
                'date' => $monday,
                'teacher_id' => 1,
                'start_time' => '07:00:00',
                'end_time' => '08:30:00',
                'amount' => 30,
                'status' => 0,
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'purpose' => 'Dạy môn Toán lớp 10A2',
                'date' => $monday,
                'teacher_id' => 2,
                'start_time' => '07:00:00',
                'end_time' => '09:35:00',
                'amount' => 30,
                'status' => 0,
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'purpose' => 'Dạy môn Toán lớp 10A3',
                'date' => $monday,
                'teacher_id' => 3,
                'start_time' => '09:35:00',
                'end_time' => '10:50:00',
                'amount' => 35,
                'status' => 0,
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'purpose' => 'Dạy môn Toán lớp 10A4',
                'date' => $monday,
                'teacher_id' => 1,
                'start_time' => '09:35:00',
                'end_time' => '11:30:00',
                'amount' => 25,
                'status' => 0,
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'purpose' => 'Dạy môn Toán lớp 10A5',
                'date' => $monday,
                'teacher_id' => 2,
                'start_time' => '10:30:00',
                'end_time' => '11:30:00',
                'amount' => 24,
                'status' => 0,
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'purpose' => 'Dạy môn Văn lớp 11A1',
                'date' => $monday,
                'teacher_id' => 7,
                'start_time' => '07:00:00',
                'end_time' => '10:30:00',
                'amount' => 20,
                'status' => 0,
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'purpose' => 'Dạy môn Văn lớp 11A2',
                'date' => $monday,
                'teacher_id' => 6,
                'start_time' => '12:00:00',
                'end_time' => '16:00:00',
                'amount' => 20,
                'status' => 0,
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'purpose' => 'Dạy môn Vật Lý lớp 11A3',
                'date' => $monday,
                'teacher_id' => 14,
                'start_time' => '15:50:00',
                'end_time' => '16:40:00',
                'amount' => 20,
                'status' => 0,
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'purpose' => 'Dạy môn Vật Lý lớp 12A1',
                'date' => $monday,
                'teacher_id' => 15,
                'start_time' => '13:15:00',
                'end_time' => '14:50:00',
                'amount' => 30,
                'status' => 0,
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'purpose' => 'Dạy môn Vật Lý lớp 10A4',
                'date' => $monday,
                'teacher_id' => 13,
                'start_time' => '15:00:00',
                'end_time' => '15:15:00',
                'amount' => 22,
                'status' => 0,
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'purpose' => 'Họp Tổ Toán',
                'date' => $tuesday,
                'teacher_id' => 2,
                'start_time' => '8:00:00',
                'end_time' => '9:00:00',
                'amount' => 10,
                'status' => 0,
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'purpose' => 'Dạy môn Anh Văn 12',
                'date' => $tuesday,
                'teacher_id' => 35,
                'start_time' => '8:00:00',
                'end_time' => '9:00:00',
                'amount' => 35,
                'status' => 0,
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'purpose' => 'Dạy môn Anh Văn 11',
                'date' => $tuesday,
                'teacher_id' => 33,
                'start_time' => '7:00:00',
                'end_time' => '8:30:00',
                'amount' => 33,
                'status' => 0,
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'purpose' => 'Dạy môn Lịch sử 11A1',
                'date' => $tuesday,
                'teacher_id' => 23,
                'start_time' => '9:00:00',
                'end_time' => '10:30:00',
                'amount' => 30,
                'status' => 0,
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'purpose' => 'Họp Tổ Thể dục - Quốc phòng',
                'date' => $tuesday,
                'teacher_id' => 36,
                'start_time' => '7:00:00',
                'end_time' => '7:30:00',
                'amount' => 10,
                'status' => 0,
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'purpose' => 'Ngày hội tư vấn tuyển sinh',
                'date' => $tuesday,
                'teacher_id' => 42,
                'start_time' => '7:00:00',
                'end_time' => '11:30:00',
                'amount' => 50,
                'status' => 0,
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'purpose' => 'Dạy môn Toán 12',
                'date' => $tuesday,
                'teacher_id' => 12,
                'start_time' => '8:00:00',
                'end_time' => '10:00:00',
                'amount' => 30,
                'status' => 0,
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'purpose' => 'Dạy môn Toán 12',
                'date' => $tuesday,
                'teacher_id' => 11,
                'start_time' => '8:00:00',
                'end_time' => '10:00:00',
                'amount' => 28,
                'status' => 0,
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'purpose' => 'Họp chi đoàn trường',
                'date' => $tuesday,
                'teacher_id' => 19,
                'start_time' => '15:00:00',
                'end_time' => '16:30:00',
                'amount' => 25,
                'status' => 0,
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'purpose' => 'Dạy môn Hóa học 10',
                'date' => $tuesday,
                'teacher_id' => 20,
                'start_time' => '13:00:00',
                'end_time' => '14:30:00',
                'amount' => 31,
                'status' => 0,
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'purpose' => 'Kiểm tra Toán 12A2',
                'date' => $tuesday,
                'teacher_id' => 11,
                'start_time' => '13:00:00',
                'end_time' => '13:45:00',
                'amount' => 31,
                'status' => 0,
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'purpose' => 'Ngày hội tư vấn tuyển sinh',
                'date' => $wednesday,
                'teacher_id' => 42,
                'start_time' => '13:00:00',
                'end_time' => '16:30:00',
                'amount' => 50,
                'status' => 0,
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'purpose' => 'Dạy môn Sinh học 11A2',
                'date' => $wednesday,
                'teacher_id' => 30,
                'start_time' => '15:00:00',
                'end_time' => '16:30:00',
                'amount' => 35,
                'status' => 0,
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'purpose' => 'Họp Tổ Sinh học',
                'date' => $wednesday,
                'teacher_id' => 30,
                'start_time' => '13:00:00',
                'end_time' => '13:30:00',
                'amount' => 15,
                'status' => 0,
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'purpose' => 'Dạy môn Toán 10',
                'date' => $wednesday,
                'teacher_id' => 2,
                'start_time' => '08:30:00',
                'end_time' => '11:00:00',
                'amount' => 30,
                'status' => 0,
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'purpose' => 'Dạy môn Toán 10',
                'date' => $thursday,
                'teacher_id' => 1,
                'start_time' => '09:30:00',
                'end_time' => '11:30:00',
                'amount' => 28,
                'status' => 0,
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'purpose' => 'Dạy môn Hóa 10A2',
                'date' => $thursday,
                'teacher_id' => 18,
                'start_time' => '07:00:00',
                'end_time' => '08:30:00',
                'amount' => 28,
                'status' => 0,
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'purpose' => 'Họp Tổ Ngữ Văn',
                'date' => $thursday,
                'teacher_id' => 6,
                'start_time' => '07:00:00',
                'end_time' => '07:30:00',
                'amount' => 10,
                'status' => 0,
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'purpose' => 'Họp Tổ Toán',
                'date' => $thursday,
                'teacher_id' => 1,
                'start_time' => '07:00:00',
                'end_time' => '07:30:00',
                'amount' => 10,
                'status' => 0,
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'purpose' => 'Dạy môn Toán 12',
                'date' => $thursday,
                'teacher_id' => 1,
                'start_time' => '07:30:00',
                'end_time' => '09:00:00',
                'amount' => 30,
                'status' => 0,
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'purpose' => 'Dạy môn GDCD 12',
                'date' => $friday,
                'teacher_id' => 7,
                'start_time' => '10:30:00',
                'end_time' => '11:30:00',
                'amount' => 45,
                'status' => 0,
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'purpose' => 'Dạy môn Công Nghệ 12',
                'date' => $friday,
                'teacher_id' => 14,
                'start_time' => '10:00:00',
                'end_time' => '11:00:00',
                'amount' => 40,
                'status' => 0,
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'purpose' => 'Dạy môn Địa Lý 11',
                'date' => $friday,
                'teacher_id' => 28,
                'start_time' => '12:00:00',
                'end_time' => '12:45:00',
                'amount' => 30,
                'status' => 0,
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'purpose' => 'Dạy môn Địa Lý 11',
                'date' => $friday,
                'teacher_id' => 26,
                'start_time' => '12:45:00',
                'end_time' => '13:30:00',
                'amount' => 28,
                'status' => 0,
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'purpose' => 'Dạy môn Tiếng Anh 11',
                'date' => $friday,
                'teacher_id' => 34,
                'start_time' => '14:00:00',
                'end_time' => '15:30:00',
                'amount' => 28,
                'status' => 0,
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'purpose' => 'Dạy môn Tiếng Anh 12',
                'date' => $friday,
                'teacher_id' => 34,
                'start_time' => '07:45:00',
                'end_time' => '09:15:00',
                'amount' => 35,
                'status' => 0,
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'purpose' => 'Họp Tổ Tiếng Anh',
                'date' => $saturday,
                'teacher_id' => 34,
                'start_time' => '07:00:00',
                'end_time' => '07:30:00',
                'amount' => 15,
                'status' => 0,
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'purpose' => 'Sinh hoạt lớp 10A1',
                'date' => $saturday,
                'teacher_id' => 2,
                'start_time' => '10:30:00',
                'end_time' => '11:15:00',
                'amount' => 30,
                'status' => 0,
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'purpose' => 'Sinh hoạt lớp 10A3',
                'date' => $saturday,
                'teacher_id' => 4,
                'start_time' => '10:30:00',
                'end_time' => '11:15:00',
                'amount' => 30,
                'status' => 0,
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'purpose' => 'Dạy môn Lịch sử 12',
                'date' => $saturday,
                'teacher_id' => 23,
                'start_time' => '07:00:00',
                'end_time' => '07:45:00',
                'amount' => 35,
                'status' => 0,
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'purpose' => 'Dạy môn Sinh học 11',
                'date' => $saturday,
                'teacher_id' => 31,
                'start_time' => '14:00:00',
                'end_time' => '14:45:00',
                'amount' => 35,
                'status' => 0,
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'purpose' => 'Họp Tổ Ngoại Ngữ',
                'date' => $sunday,
                'teacher_id' => 33,
                'start_time' => '07:00:00',
                'end_time' => '08:00:00',
                'amount' => 20,
                'status' => 0,
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
        ]);
    }
}
