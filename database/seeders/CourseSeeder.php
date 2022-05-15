<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
            'name' => '2022年沖縄教室',
        ]);
        DB::table('courses')->insert([
            'name' => '2022年日本橋教室A',
        ]);
        DB::table('courses')->insert([
            'name' => '2022年新宿教室',
        ]);
        DB::table('courses')->insert([
            'name' => '2022年大阪教室',
        ]);
    }
}
