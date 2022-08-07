<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('courses')->insert([
            [
                'name' => 'Toán 10 (Nguyễn Thị Mỹ Linh)',
                'code' => 'TN1001',
                'teacher_id' => 1,
                'introduce' => NULL,
            ],
            [
                'name' => 'Toán 10 (Nguyễn Thanh Huy)',
                'code' => 'TN1002',
                'teacher_id' => 2,
                'introduce' => NULL,
            ],
            [
                'name' => 'Toán 10 (Nguyễn Thành Long)',
                'code' => 'TN1003',
                'teacher_id' => 3,
                'introduce' => NULL,
            ],
            [
                'name' => 'Toán 10 (Nguyễn Việt Tiến)',
                'code' => 'TN1004',
                'teacher_id' => 12,
                'introduce' => NULL,
            ],
            [
                'name' => 'Ngữ Văn 10 (Nguyễn Duy Quang)',
                'code' => 'NV1001',
                'teacher_id' => 5,
                'introduce' => NULL,
            ],
            [
                'name' => 'Ngữ Văn 10 (Lâm Thị Kim Thi)',
                'code' => 'NV1002',
                'teacher_id' => 6,
                'introduce' => NULL,
            ],
            [
                'name' => 'Ngữ Văn 10 (Nguyễn Anh Thư)',
                'code' => 'NV1003',
                'teacher_id' => 10,
                'introduce' => NULL,
            ],
            [
                'name' => 'Ngữ Văn 10 (Lê Như Quỳnh)',
                'code' => 'NV1004',
                'teacher_id' => 8,
                'introduce' => NULL,
            ],
            [
                'name' => 'Vật Lý 10 (Nguyễn Anh Quân)',
                'code' => 'VL1001',
                'teacher_id' => 13,
                'introduce' => NULL,
            ],
            [
                'name' => 'Vật Lý 10 (Nguyễn Việt Hoàng)',
                'code' => 'VL1002',
                'teacher_id' => 14,
                'introduce' => NULL,
            ],
            [
                'name' => 'Vật Lý 10 (Trần Anh Duy)',
                'code' => 'VL1003',
                'teacher_id' => 15,
                'introduce' => NULL,
            ],
            [
                'name' => 'Hóa học 10 (Trần Gia Hưng)',
                'code' => 'HH1001',
                'teacher_id' => 18,
                'introduce' => NULL,
            ],
            [
                'name' => 'Hóa học 10 (Võ Nguyễn Hoài Nam)',
                'code' => 'HH1002',
                'teacher_id' => 19,
                'introduce' => NULL,
            ],
            [
                'name' => 'Hóa học 10 (Trần Thị Thanh Tuyền)',
                'code' => 'HH1003',
                'teacher_id' => 20,
                'introduce' => NULL,
            ],
            [
                'name' => 'Lịch sử 10 (Lê Thùy Linh)',
                'code' => 'LS1001',
                'teacher_id' => 24,
                'introduce' => NULL,
            ],
            [
                'name' => 'Lịch sử 10 (Phan Thị Diệu Hiền)',
                'code' => 'LS1002',
                'teacher_id' => 25,
                'introduce' => NULL,
            ],
            [
                'name' => 'Địa lý 10 (Phạm Hồng Ngọc)',
                'code' => 'DL1001',
                'teacher_id' => 27,
                'introduce' => NULL,
            ],
            [
                'name' => 'Địa lý 10 (Phạm Thị Hồng Thủy)',
                'code' => 'DL1002',
                'teacher_id' => 28,
                'introduce' => NULL,
            ],
            [
                'name' => 'Sinh học 10 (Hoàng Quốc Việt)',
                'code' => 'SH1001',
                'teacher_id' => 31,
                'introduce' => NULL,
            ],
            [
                'name' => 'Sinh học 10 (Nguyễn Trần Trung Tín)',
                'code' => 'SH1002',
                'teacher_id' => 29,
                'introduce' => NULL,
            ],
            [
                'name' => 'Tiếng Anh 10 (Kiều Tố Linh)',
                'code' => 'TA1001',
                'teacher_id' => 32,
                'introduce' => NULL,
            ],
            [
                'name' => 'Tiếng Anh 10 (Nguyễn Hoàng Đông)',
                'code' => 'TA1002',
                'teacher_id' => 33,
                'introduce' => NULL,
            ],
            [
                'name' => 'Tiếng Anh 10 (Võ Hoàng Yến)',
                'code' => 'TA1003',
                'teacher_id' => 34,
                'introduce' => NULL,
            ],
            [
                'name' => 'Tin học 10 (Nguyễn Hồ Hải Đăng)',
                'code' => 'TH1001',
                'teacher_id' => 40,
                'introduce' => NULL,
            ],
            [
                'name' => 'Thể dục 10 (Trần Thanh Tân)',
                'code' => 'TD1001',
                'teacher_id' => 38,
                'introduce' => NULL,
            ],
            [
                'name' => 'Quốc phòng 10 (Nguyễn Quốc Mạnh)',
                'code' => 'QP1001',
                'teacher_id' => 39,
                'introduce' => NULL,
            ],
            [
                'name' => 'Giáo dục công dân 10 (Lâm Thị Kim Thi)',
                'code' => 'CD1001',
                'teacher_id' => 6,
                'introduce' => NULL,
            ],
            [
                'name' => 'Giáo dục công dân 10 (Nguyễn Hà Tú Anh)',
                'code' => 'CD1002',
                'teacher_id' => 9,
                'introduce' => NULL,
            ],
            [
                'name' => 'Công nghệ 10 (Nguyễn Anh Quân)',
                'code' => 'CN1001',
                'teacher_id' => 13,
                'introduce' => NULL,
            ],
            [
                'name' => 'Toán 11 (Lê Thị Thúy Vy)',
                'code' => 'TN1101',
                'teacher_id' => 4,
                'introduce' => NULL,
            ],
            [
                'name' => 'Toán 11 (Nguyễn Trí Bảo)',
                'code' => 'TN1102',
                'teacher_id' => 11,
                'introduce' => NULL,
            ],
            [
                'name' => 'Toán 11 (Nguyễn Thanh Huy)',
                'code' => 'TN1103',
                'teacher_id' => 2,
                'introduce' => NULL,
            ],
            [
                'name' => 'Ngữ Văn 11 (Nguyễn Thị Mỹ Duyên)',
                'code' => 'NV1101',
                'teacher_id' => 7,
                'introduce' => NULL,
            ],
            [
                'name' => 'Ngữ Văn 11 (Nguyễn Hà Tú Anh)',
                'code' => 'NV1102',
                'teacher_id' => 9,
                'introduce' => NULL,
            ],
            [
                'name' => 'Ngữ Văn 11 (Nguyễn Anh Thư)',
                'code' => 'NV1103',
                'teacher_id' => 10,
                'introduce' => NULL,
            ],
            [
                'name' => 'Vật Lý 11 (Nguyễn Thị Đan Thanh)',
                'code' => 'VL1101',
                'teacher_id' => 16,
                'introduce' => NULL,
            ],
            [
                'name' => 'Vật Lý 11 (Võ Xuân Trúc)',
                'code' => 'VL1102',
                'teacher_id' => 17,
                'introduce' => NULL,
            ],
            [
                'name' => 'Hóa học 11 (Trần Thị Thanh Tuyền)',
                'code' => 'HH1101',
                'teacher_id' => 20,
                'introduce' => NULL,
            ],
            [
                'name' => 'Hóa học 11 (Nguyễn Văn Sáu)',
                'code' => 'HH1102',
                'teacher_id' => 21,
                'introduce' => NULL,
            ],
            [
                'name' => 'Lịch sử 11 (Nguyễn Văn Chính)',
                'code' => 'LS1101',
                'teacher_id' => 23,
                'introduce' => NULL,
            ],
            [
                'name' => 'Lịch sử 11 (Phan Thị Diệu Hiền)',
                'code' => 'LS1102',
                'teacher_id' => 25,
                'introduce' => NULL,
            ],
            [
                'name' => 'Địa lý 11 (Nguyễn Thị Minh)',
                'code' => 'DL1101',
                'teacher_id' => 26,
                'introduce' => NULL,
            ],
            [
                'name' => 'Địa lý 11 (Phạm Thị Hồng Thủy)',
                'code' => 'DL1102',
                'teacher_id' => 28,
                'introduce' => NULL,
            ],
            [
                'name' => 'Sinh học 11 (Nguyễn Thị Kim Thúy)',
                'code' => 'SH1101',
                'teacher_id' => 30,
                'introduce' => NULL,
            ],
            [
                'name' => 'Sinh học 11 (Hoàng Quốc Việt)',
                'code' => 'SH1102',
                'teacher_id' => 31,
                'introduce' => NULL,
            ],
            [
                'name' => 'Tiếng Anh 11 (Võ Hoàng Yến)',
                'code' => 'TA1101',
                'teacher_id' => 34,
                'introduce' => NULL,
            ],
            [
                'name' => 'Tiếng Anh 11 (Phan Huỳnh Anh)',
                'code' => 'TA1102',
                'teacher_id' => 35,
                'introduce' => NULL,
            ],
            [
                'name' => 'Tiếng Anh 11 (Nguyễn Hoàng Đông)',
                'code' => 'TA1103',
                'teacher_id' => 33,
                'introduce' => NULL,
            ],
            [
                'name' => 'Tin học 11 (Võ Nguyễn Trường An)',
                'code' => 'TH1101',
                'teacher_id' => 39,
                'introduce' => NULL,
            ],
            [
                'name' => 'Thể dục 10 (Trần Bá Dương)',
                'code' => 'TD1101',
                'teacher_id' => 36,
                'introduce' => NULL,
            ],
            [
                'name' => 'Quốc phòng 11 (Nguyễn Quốc Mạnh)',
                'code' => 'QP1101',
                'teacher_id' => 39,
                'introduce' => NULL,
            ],
            [
                'name' => 'Công nghệ 11 (Nguyễn Anh Quân)',
                'code' => 'CN1101',
                'teacher_id' => 13,
                'introduce' => NULL,
            ],
            [
                'name' => 'Giáo dục công dân 11 (Nguyễn Anh Thư)',
                'code' => 'CD1101',
                'teacher_id' => 10,
                'introduce' => NULL,
            ],
            [
                'name' => 'Toán 12 (Nguyễn Thị Mỹ Linh)',
                'code' => 'TN1201',
                'teacher_id' => 1,
                'introduce' => NULL,
            ],
            [
                'name' => 'Toán 12 (Nguyễn Việt Tiến)',
                'code' => 'TN1202',
                'teacher_id' => 12,
                'introduce' => NULL,
            ],
            [
                'name' => 'Toán 12 (Nguyễn Trí Bảo)',
                'code' => 'TN1203',
                'teacher_id' => 11,
                'introduce' => NULL,
            ],
            [
                'name' => 'Vật Lý 12 (Võ Xuân Trúc)',
                'code' => 'VL1201',
                'teacher_id' => 17,
                'introduce' => NULL,
            ],
            [
                'name' => 'Vật Lý 12 (Trần Anh Duy)',
                'code' => 'VL1202',
                'teacher_id' => 15,
                'introduce' => NULL,
            ],
            [
                'name' => 'Hóa học 12 (Nguyễn Văn Thảo)',
                'code' => 'HH1201',
                'teacher_id' => 22,
                'introduce' => NULL,
            ],
            [
                'name' => 'Hóa học 12 (Nguyễn Văn Sáu)',
                'code' => 'HH1202',
                'teacher_id' => 21,
                'introduce' => NULL,
            ],
            [
                'name' => 'Lịch sử 12 (Nguyễn Văn Chính)',
                'code' => 'LS1201',
                'teacher_id' => 23,
                'introduce' => NULL,
            ],
            [
                'name' => 'Lịch sử 12 (Lê Thùy Linh)',
                'code' => 'LS1202',
                'teacher_id' => 24,
                'introduce' => NULL,
            ],
            [
                'name' => 'Địa lý 12 (Nguyễn Thị Minh)',
                'code' => 'DL1201',
                'teacher_id' => 26,
                'introduce' => NULL,
            ],
            [
                'name' => 'Địa lý 12 (Phạm Hồng Ngọc)',
                'code' => 'DL1202',
                'teacher_id' => 27,
                'introduce' => NULL,
            ],
            [
                'name' => 'Sinh học 12 (Nguyễn Trần Trung Tín)',
                'code' => 'SH1201',
                'teacher_id' => 29,
                'introduce' => NULL,
            ],
            [
                'name' => 'Sinh học 12 (Nguyễn Thị Kim Thúy)',
                'code' => 'SH1202',
                'teacher_id' => 30,
                'introduce' => NULL,
            ],
            [
                'name' => 'Tiếng Anh 12 (Kiều Tố Linh)',
                'code' => 'TA1201',
                'teacher_id' => 32,
                'introduce' => NULL,
            ],
            [
                'name' => 'Tiếng Anh 12 (Phan Huỳnh Anh)',
                'code' => 'TA1202',
                'teacher_id' => 35,
                'introduce' => NULL,
            ],
            [
                'name' => 'Công nghệ 12 (Nguyễn Việt Hoàng)',
                'code' => 'CN1201',
                'teacher_id' => 14,
                'introduce' => NULL,
            ],
            [
                'name' => 'Thể dục 12 (Trần Bá Dương)',
                'code' => 'TD1201',
                'teacher_id' => 36,
                'introduce' => NULL,
            ],
            [
                'name' => 'Thể dục 12 (Lê Văn Xuân)',
                'code' => 'TD1202',
                'teacher_id' => 37,
                'introduce' => NULL,
            ],
            [
                'name' => 'Quốc phòng 12 (Lê Văn Xuân)',
                'code' => 'QP1201',
                'teacher_id' => 37,
                'introduce' => NULL,
            ],
            [
                'name' => 'Quốc phòng 12 (Nguyễn Quốc Mạnh)',
                'code' => 'QP1202',
                'teacher_id' => 39,
                'introduce' => NULL,
            ],
            [
                'name' => 'Tin học 12 (Nguyễn Hồ Hải Đăng)',
                'code' => 'TH1201',
                'teacher_id' => 40,
                'introduce' => NULL,
            ],
            [
                'name' => 'Tin học 12 (Võ Nguyễn Trường An)',
                'code' => 'TH1202',
                'teacher_id' => 39,
                'introduce' => NULL,
            ],
            [
                'name' => 'Giáo dục công dân 12 (Nguyễn Thị Mỹ Duyên)',
                'code' => 'CD1201',
                'teacher_id' => 7,
                'introduce' => NULL,
            ],
        ]);
    }
}
