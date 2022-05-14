<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubmissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('submissions')->insert([
            'user_id' => 1,
            'category' => 'Web',
            'lesson_name' => '演習問題1',
            'comment' => 'コメント',
            'url' => 'http://localhost:8888',
        ]);
        DB::table('submissions')->insert([
            'user_id' => 1,
            'category' => 'Java1',
            'lesson_name' => '演習問題1',
            'comment' => 'コメント',
            'url' => 'http://localhost:8888',
        ]);
        DB::table('submissions')->insert([
            'user_id' => 1,
            'category' => 'Java1',
            'lesson_name' => '演習問題2',
            'comment' => 'コメント',
            'url' => 'http://localhost:8888',
        ]);
        DB::table('submissions')->insert([
            'user_id' => 1,
            'category' => 'Java1',
            'lesson_name' => '演習問題3',
            'comment' => 'コメント',
            'url' => 'http://localhost:8888',
        ]);
        DB::table('submissions')->insert([
            'user_id' => 2,
            'category' => 'Java1',
            'lesson_name' => '演習問題1',
            'comment' => 'コメント',
            'url' => 'http://localhost:8888',
        ]);
        DB::table('submissions')->insert([
            'user_id' => 2,
            'category' => 'Java1',
            'lesson_name' => '演習問題2',
            'comment' => 'コメント',
            'url' => 'http://localhost:8888',
        ]);
        DB::table('submissions')->insert([
            'user_id' => 3,
            'category' => 'Java1',
            'lesson_name' => '演習問題1',
            'comment' => 'コメント',
            'url' => 'http://localhost:8888',
        ]);
    }
}
