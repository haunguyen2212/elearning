<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dateTime = Carbon::now()->format('Y-m-d H:i:s');

        DB::table('students')->insert([
            [
                'username' => 'ST0001',
                'name' => 'Trần Thúy An',
                'class_id' => 1,
                'gender' => 1,
                'date_of_birth' => '2007-04-03',
                'place_of_birth' => 'Cần Thơ',
                'address' => NULL,
                'password' => Hash::make('12345678'),
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'username' => 'ST0002',
                'name' => 'Vũ Nguyễn Hoài An',
                'class_id' => 1,
                'gender' => 0,
                'date_of_birth' => '2007-08-13',
                'place_of_birth' => 'Cần Thơ',
                'address' => NULL,
                'password' => Hash::make('12345678'),
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'username' => 'ST0003',
                'name' => 'Nguyễn Đặng Kim Anh',
                'class_id' => 1,
                'gender' => 1,
                'date_of_birth' => '2007-12-04',
                'place_of_birth' => 'Cần Thơ',
                'address' => NULL,
                'password' => Hash::make('12345678'),
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'username' => 'ST0004',
                'name' => 'Trần Hoàng Duy',
                'class_id' => 1,
                'gender' => 0,
                'date_of_birth' => '2007-01-06',
                'place_of_birth' => 'Cần Thơ',
                'address' => NULL,
                'password' => Hash::make('12345678'),
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'username' => 'ST0005',
                'name' => 'Trịnh Thị Giang',
                'class_id' => 1,
                'gender' => 1,
                'date_of_birth' => '2007-12-17',
                'place_of_birth' => 'Cần Thơ',
                'address' => NULL,
                'password' => Hash::make('12345678'),
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'username' => 'ST0006',
                'name' => 'Trịnh Thị Giang',
                'class_id' => 1,
                'gender' => 1,
                'date_of_birth' => '2007-11-11',
                'place_of_birth' => 'TP Hồ Chí Minh',
                'address' => NULL,
                'password' => Hash::make('12345678'),
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'username' => 'ST0007',
                'name' => 'Lê Thị Ngọc Hân',
                'class_id' => 1,
                'gender' => 1,
                'date_of_birth' => '2006-10-06',
                'place_of_birth' => 'Cần Thơ',
                'address' => NULL,
                'password' => Hash::make('12345678'),
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'username' => 'ST0008',
                'name' => 'Nguyễn Dương Gia Hân',
                'class_id' => 1,
                'gender' => 1,
                'date_of_birth' => '2007-04-30',
                'place_of_birth' => 'Cần Thơ',
                'address' => NULL,
                'password' => Hash::make('12345678'),
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'username' => 'ST0009',
                'name' => 'Lê Thúy Hằng',
                'class_id' => 1,
                'gender' => 1,
                'date_of_birth' => '2007-02-28',
                'place_of_birth' => 'Cần Thơ',
                'address' => NULL,
                'password' => Hash::make('12345678'),
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'username' => 'ST0010',
                'name' => 'Trần Lê Hiếu Hạnh',
                'class_id' => 1,
                'gender' => 1,
                'date_of_birth' => '2007-07-22',
                'place_of_birth' => 'Cần Thơ',
                'address' => NULL,
                'password' => Hash::make('12345678'),
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'username' => 'ST0011',
                'name' => 'Nguyễn Huy Hoàng',
                'class_id' => 1,
                'gender' => 0,
                'date_of_birth' => '2007-12-28',
                'place_of_birth' => 'Vĩnh Long',
                'address' => NULL,
                'password' => Hash::make('12345678'),
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'username' => 'ST0012',
                'name' => 'Ngô Quốc Khánh',
                'class_id' => 1,
                'gender' => 0,
                'date_of_birth' => '2007-06-12',
                'place_of_birth' => 'Cần Thơ',
                'address' => NULL,
                'password' => Hash::make('12345678'),
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'username' => 'ST0013',
                'name' => 'Hà Trung Kiên',
                'class_id' => 1,
                'gender' => 0,
                'date_of_birth' => '2007-02-11',
                'place_of_birth' => 'Cần Thơ',
                'address' => NULL,
                'password' => Hash::make('12345678'),
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'username' => 'ST0014',
                'name' => 'Nguyễn Trần Khánh Linh',
                'class_id' => 1,
                'gender' => 1,
                'date_of_birth' => '2007-12-18',
                'place_of_birth' => 'Cần Thơ',
                'address' => NULL,
                'password' => Hash::make('12345678'),
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'username' => 'ST0015',
                'name' => 'Dương Mỹ Linh',
                'class_id' => 1,
                'gender' => 1,
                'date_of_birth' => '2007-09-09',
                'place_of_birth' => 'Cần Thơ',
                'address' => NULL,
                'password' => Hash::make('12345678'),
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'username' => 'ST0016',
                'name' => 'Nguyễn Tuấn Nghĩa',
                'class_id' => 1,
                'gender' => 0,
                'date_of_birth' => '2007-12-08',
                'place_of_birth' => 'Cần Thơ',
                'address' => NULL,
                'password' => Hash::make('12345678'),
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'username' => 'ST0017',
                'name' => 'Huỳnh Xuân Nghiêm',
                'class_id' => 1,
                'gender' => 0,
                'date_of_birth' => '2006-04-11',
                'place_of_birth' => 'Cần Thơ',
                'address' => NULL,
                'password' => Hash::make('12345678'),
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'username' => 'ST0018',
                'name' => 'Trần Hồng Ngọc',
                'class_id' => 1,
                'gender' => 1,
                'date_of_birth' => '2007-12-19',
                'place_of_birth' => 'Cần Thơ',
                'address' => NULL,
                'password' => Hash::make('12345678'),
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'username' => 'ST0019',
                'name' => 'Ngô Yến Nhi',
                'class_id' => 1,
                'gender' => 1,
                'date_of_birth' => '2007-06-05',
                'place_of_birth' => 'Cần Thơ',
                'address' => NULL,
                'password' => Hash::make('12345678'),
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'username' => 'ST0020',
                'name' => 'Phạm Ngọc Như',
                'class_id' => 1,
                'gender' => 1,
                'date_of_birth' => '2007-05-08',
                'place_of_birth' => 'Cần Thơ',
                'address' => NULL,
                'password' => Hash::make('12345678'),
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'username' => 'ST0021',
                'name' => 'Trần Anh Quân',
                'class_id' => 1,
                'gender' => 0,
                'date_of_birth' => '2007-08-12',
                'place_of_birth' => 'Cần Thơ',
                'address' => NULL,
                'password' => Hash::make('12345678'),
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'username' => 'ST0022',
                'name' => 'Nguyễn Giang Sơn',
                'class_id' => 1,
                'gender' => 0,
                'date_of_birth' => '2007-11-08',
                'place_of_birth' => 'Cần Thơ',
                'address' => NULL,
                'password' => Hash::make('12345678'),
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'username' => 'ST0023',
                'name' => 'Đồng Quang Thái',
                'class_id' => 1,
                'gender' => 0,
                'date_of_birth' => '2007-10-22',
                'place_of_birth' => 'Cần Thơ',
                'address' => NULL,
                'password' => Hash::make('12345678'),
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'username' => 'ST0024',
                'name' => 'Nguyễn Huỳnh Thanh Thảo',
                'class_id' => 1,
                'gender' => 1,
                'date_of_birth' => '2007-12-25',
                'place_of_birth' => 'Cần Thơ',
                'address' => NULL,
                'password' => Hash::make('12345678'),
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'username' => 'ST0025',
                'name' => 'Lê Phương Thảo',
                'class_id' => 1,
                'gender' => 1,
                'date_of_birth' => '2007-01-01',
                'place_of_birth' => 'Cần Thơ',
                'address' => NULL,
                'password' => Hash::make('12345678'),
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'username' => 'ST0026',
                'name' => 'Nguyễn Thị Ngọc Thơ',
                'class_id' => 1,
                'gender' => 1,
                'date_of_birth' => '2007-06-01',
                'place_of_birth' => 'Cần Thơ',
                'address' => NULL,
                'password' => Hash::make('12345678'),
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'username' => 'ST0027',
                'name' => 'Phạm Huỳnh Bảo Thư',
                'class_id' => 1,
                'gender' => 1,
                'date_of_birth' => '2007-09-08',
                'place_of_birth' => 'Cần Thơ',
                'address' => NULL,
                'password' => Hash::make('12345678'),
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'username' => 'ST0028',
                'name' => 'Nguyễn Minh Tú',
                'class_id' => 1,
                'gender' => 0,
                'date_of_birth' => '2007-07-07',
                'place_of_birth' => 'Cần Thơ',
                'address' => NULL,
                'password' => Hash::make('12345678'),
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'username' => 'ST0029',
                'name' => 'Phạm Duy Bảo Việt',
                'class_id' => 1,
                'gender' => 0,
                'date_of_birth' => '2007-02-08',
                'place_of_birth' => 'Cần Thơ',
                'address' => NULL,
                'password' => Hash::make('12345678'),
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'username' => 'ST0030',
                'name' => '	Đỗ Xuân Vinh',
                'class_id' => 1,
                'gender' => 0,
                'date_of_birth' => '2007-12-30',
                'place_of_birth' => 'Cần Thơ',
                'address' => NULL,
                'password' => Hash::make('12345678'),
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'username' => 'ST0031',
                'name' => 'Lục Hoàng Anh',
                'class_id' => 2,
                'gender' => 0,
                'date_of_birth' => '2007-05-21',
                'place_of_birth' => 'Cần Thơ',
                'address' => NULL,
                'password' => Hash::make('12345678'),
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'username' => 'ST0032',
                'name' => 'Võ Đặng Lan Anh',
                'class_id' => 2,
                'gender' => 1,
                'date_of_birth' => '2007-02-22',
                'place_of_birth' => 'Cần Thơ',
                'address' => NULL,
                'password' => Hash::make('12345678'),
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'username' => 'ST0033',
                'name' => 'Lê Trung Chánh',
                'class_id' => 2,
                'gender' => 1,
                'date_of_birth' => '2007-01-12',
                'place_of_birth' => 'Cần Thơ',
                'address' => NULL,
                'password' => Hash::make('12345678'),
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'username' => 'ST0034',
                'name' => 'Trần Mỹ Duyên',
                'class_id' => 2,
                'gender' => 1,
                'date_of_birth' => '2007-12-23',
                'place_of_birth' => 'Cà Mau',
                'address' => NULL,
                'password' => Hash::make('12345678'),
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'username' => 'ST0035',
                'name' => 'Huỳnh Tấn Đạt',
                'class_id' => 2,
                'gender' => 0,
                'date_of_birth' => '2006-10-10',
                'place_of_birth' => 'Long An',
                'address' => NULL,
                'password' => Hash::make('12345678'),
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'username' => 'ST0036',
                'name' => 'Nguyễn Mạnh Hùng',
                'class_id' => 2,
                'gender' => 0,
                'date_of_birth' => '2007-12-30',
                'place_of_birth' => 'Cần Thơ',
                'address' => NULL,
                'password' => Hash::make('12345678'),
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'username' => 'ST0037',
                'name' => 'Trần Hoàng Khang',
                'class_id' => 2,
                'gender' => 0,
                'date_of_birth' => '2007-04-23',
                'place_of_birth' => 'Cần Thơ',
                'address' => NULL,
                'password' => Hash::make('12345678'),
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'username' => 'ST0038',
                'name' => 'Cao Lê Nhật Linh',
                'class_id' => 2,
                'gender' => 1,
                'date_of_birth' => '2007-03-20',
                'place_of_birth' => 'Cần Thơ',
                'address' => NULL,
                'password' => Hash::make('12345678'),
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'username' => 'ST0039',
                'name' => 'Trần Nguyễn Huyền My',
                'class_id' => 2,
                'gender' => 1,
                'date_of_birth' => '2007-05-29',
                'place_of_birth' => 'Cần Thơ',
                'address' => NULL,
                'password' => Hash::make('12345678'),
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'username' => 'ST0040',
                'name' => 'Hoàng Nguyễn Bảo Ngọc',
                'class_id' => 2,
                'gender' => 1,
                'date_of_birth' => '2007-11-23',
                'place_of_birth' => 'Cần Thơ',
                'address' => NULL,
                'password' => Hash::make('12345678'),
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'username' => 'ST0041',
                'name' => 'Trần Hữu Nhân',
                'class_id' => 2,
                'gender' => 0,
                'date_of_birth' => '2007-10-09',
                'place_of_birth' => 'Cần Thơ',
                'address' => NULL,
                'password' => Hash::make('12345678'),
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'username' => 'ST0042',
                'name' => 'Nguyễn Thị Quỳnh Như',
                'class_id' => 2,
                'gender' => 1,
                'date_of_birth' => '2007-11-19',
                'place_of_birth' => 'Cần Thơ',
                'address' => NULL,
                'password' => Hash::make('12345678'),
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'username' => 'ST0043',
                'name' => 'Nguyễn Hoàng Phúc',
                'class_id' => 2,
                'gender' => 0,
                'date_of_birth' => '2007-05-18',
                'place_of_birth' => 'Cần Thơ',
                'address' => NULL,
                'password' => Hash::make('12345678'),
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'username' => 'ST0044',
                'name' => 'Nguyễn Văn Phúc',
                'class_id' => 2,
                'gender' => 0,
                'date_of_birth' => '2007-06-09',
                'place_of_birth' => 'Cần Thơ',
                'address' => NULL,
                'password' => Hash::make('12345678'),
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'username' => 'ST0045',
                'name' => 'Phạm Hữu Sáng',
                'class_id' => 2,
                'gender' => 0,
                'date_of_birth' => '2007-09-08',
                'place_of_birth' => 'Cần Thơ',
                'address' => NULL,
                'password' => Hash::make('12345678'),
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'username' => 'ST0046',
                'name' => 'Nguyễn Hoàng Anh Tài',
                'class_id' => 2,
                'gender' => 0,
                'date_of_birth' => '2007-06-12',
                'place_of_birth' => 'Cần Thơ',
                'address' => NULL,
                'password' => Hash::make('12345678'),
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'username' => 'ST0047',
                'name' => 'Nguyễn Thái Thanh',
                'class_id' => 2,
                'gender' => 0,
                'date_of_birth' => '2007-09-18',
                'place_of_birth' => 'Cần Thơ',
                'address' => NULL,
                'password' => Hash::make('12345678'),
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'username' => 'ST0048',
                'name' => 'Nguyễn Tuấn Thuận',
                'class_id' => 2,
                'gender' => 0,
                'date_of_birth' => '2007-07-19',
                'place_of_birth' => 'Cần Thơ',
                'address' => NULL,
                'password' => Hash::make('12345678'),
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'username' => 'ST0049',
                'name' => 'Nguyễn Thị Thanh Thúy',
                'class_id' => 2,
                'gender' => 1,
                'date_of_birth' => '2007-04-30',
                'place_of_birth' => 'Cần Thơ',
                'address' => NULL,
                'password' => Hash::make('12345678'),
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'username' => 'ST0050',
                'name' => 'Phạm Minh Thư',
                'class_id' => 2,
                'gender' => 1,
                'date_of_birth' => '2007-11-23',
                'place_of_birth' => 'Cần Thơ',
                'address' => NULL,
                'password' => Hash::make('12345678'),
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'username' => 'ST0051',
                'name' => 'Hoàng Thu Trang',
                'class_id' => 2,
                'gender' => 1,
                'date_of_birth' => '2007-10-23',
                'place_of_birth' => 'Cần Thơ',
                'address' => NULL,
                'password' => Hash::make('12345678'),
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'username' => 'ST0052',
                'name' => 'Bùi Thị Thanh Trúc',
                'class_id' => 2,
                'gender' => 1,
                'date_of_birth' => '2007-01-30',
                'place_of_birth' => 'Cần Thơ',
                'address' => NULL,
                'password' => Hash::make('12345678'),
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'username' => 'ST0053',
                'name' => 'Nguyễn Trần Anh Tuấn',
                'class_id' => 2,
                'gender' => 0,
                'date_of_birth' => '2007-02-28',
                'place_of_birth' => 'Vĩnh Long',
                'address' => NULL,
                'password' => Hash::make('12345678'),
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'username' => 'ST0054',
                'name' => 'Dương Quang Vinh',
                'class_id' => 2,
                'gender' => 0,
                'date_of_birth' => '2007-03-13',
                'place_of_birth' => 'Đồng Nai',
                'address' => NULL,
                'password' => Hash::make('12345678'),
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'username' => 'ST0055',
                'name' => 'Đào Phi Yến',
                'class_id' => 2,
                'gender' => 1,
                'date_of_birth' => '2007-09-16',
                'place_of_birth' => 'Cần Thơ',
                'address' => NULL,
                'password' => Hash::make('12345678'),
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'username' => 'ST0056',
                'name' => 'Nguyễn Bùi Mỹ Á',
                'class_id' => 3,
                'gender' => 1,
                'date_of_birth' => '2007-08-05',
                'place_of_birth' => 'Cần Thơ',
                'address' => NULL,
                'password' => Hash::make('12345678'),
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
            [
                'username' => 'ST0057',
                'name' => 'Trần Hoàng Anh',
                'class_id' => 3,
                'gender' => 0,
                'date_of_birth' => '2007-12-13',
                'place_of_birth' => 'Cần Thơ',
                'address' => NULL,
                'password' => Hash::make('12345678'),
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
        ]);
    }
}
