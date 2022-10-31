<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('questions')->insert([
            [
                'question' => '<p>Trong các câu sau, câu nào là mệnh đề?</p>',
                'correct_answer' => '1',
                'answer_a' => '<p>Trung Quốc là nước đông dân nhất thế giới.</p>',
                'answer_b' => '<p>Bạn học trường nào?</p>',
                'answer_c' => '<p>Đi ngủ đi!</p>',
                'answer_d' => '<p>Không được làm việc riêng trong giờ học.</p>',
                'image' => NULL,
                'explain' => '<p>Chỉ có câu “Trung Quốc là nước đông dân nhất thế giới” có thể xác định được tính đúng sai nên đáp án B là mệnh đề.</p>',
                'level' => 1,
                'teacher_id' => NULL,
                'subject_id' => 1,
                'shared' => 1,
            ],
            [
                'question' => '<p>Trong các câu sau, câu nào <strong>không</strong> phải là mệnh đề?</p>',
                'correct_answer' => '1',
                'answer_a' => '<p>Buồn ngủ quá!</p>',
                'answer_b' => '<p>Hình thoi có hai đường chéo vuông góc với nhau</p>',
                'answer_c' => '<p>8 là số chính phương</p>',
                'answer_d' => '<p>Băng Cốc là thủ đô của Mianma.</p>',
                'image' => NULL,
                'explain' => '<p>“Buồn ngủ quá!” là câu cảm thán không xác định được tính đúng sai. Do đó không phải là mệnh đề.</p>',
                'level' => 1,
                'teacher_id' => NULL,
                'subject_id' => 1,
                'shared' => 1,
            ],
            [
                'question' => '<p>Câu nào sau đây <strong>không</strong> là mệnh đề?</p>',
                'correct_answer' => '1',
                'answer_a' => '<p>x > 2;</p>',
                'answer_b' => '<p>3 < 1;</p>',
                'answer_c' => '<p>4 – 5 = 1;</p>',
                'answer_d' => '<p>Tam giác đều là tam giác có ba cạnh bằng nhau.</p>',
                'image' => NULL,
                'explain' => '<p>Vì x > 2 là mệnh đề chứa biến không xác định được tính đúng sai nên không phải mệnh đề.</p>',
                'level' => 1,
                'teacher_id' => NULL,
                'subject_id' => 1,
                'shared' => 1,
            ],
            [
                'question' => '<p>Số tập con của tập A = {1; 2; 3} là</p>',
                'correct_answer' => '4',
                'answer_a' => '<p>5</p>',
                'answer_b' => '<p>6</p>',
                'answer_c' => '<p>7</p>',
                'answer_d' => '<p>8</p>',
                'image' => NULL,
                'explain' => '<p>Các tập con gồm {1}; {2}; {3}; {1; 2}; {1;3}; {2; 3}; {1; 2; 3}; ∅.</p>',
                'level' => 1,
                'teacher_id' => NULL,
                'subject_id' => 1,
                'shared' => 1,
            ],
            [
                'question' => '<p>Số tập con có 2 phần tử của tập M = {1; 2; 3; 4; 5; 6}</p>',
                'correct_answer' => '2',
                'answer_a' => '<p>14</p>',
                'answer_b' => '<p>15</p>',
                'answer_c' => '<p>16</p>',
                'answer_d' => '<p>17</p>',
                'image' => NULL,
                'explain' => '<p>Tập con có 2 phần tử của tập M gồm: {1; 2}; {1; 3}; {1; 4}; {1; 5}; {1;6}; {2; 3}; {2; 4}; {2; 5}; {2; 6}; {3; 4}; {3; 5}; {3; 6}; {4; 5}; {4; 6}; {5; 6}.<br>Vậy tập M có 15 tập con có 2 phần tử.</p>',
                'level' => 1,
                'teacher_id' => NULL,
                'subject_id' => 1,
                'shared' => 1,
            ],
        ]);
    }
}
