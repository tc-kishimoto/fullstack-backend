<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BelongCourseSeieder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('belong_course')->insert([
            'user_id' => 5,
            'course_id' => 1
        ]);
        DB::table('belong_course')->insert([
            'user_id' => 7,
            'course_id' => 1
        ]);
        DB::table('belong_course')->insert([
            'user_id' => 8,
            'course_id' => 1
        ]);
        DB::table('belong_course')->insert([
            'user_id' => 9,
            'course_id' => 1
        ]);
        DB::table('belong_course')->insert([
            'user_id' => 10,
            'course_id' => 1
        ]);
        DB::table('belong_course')->insert([
            'user_id' => 11,
            'course_id' => 1
        ]);
        DB::table('belong_course')->insert([
            'user_id' => 12,
            'course_id' => 2
        ]);
    }
}
