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
            'user_id' => 7,
            'category' => 'Web',
            'lesson_name' => '演習問題1',
            'comment' => '提出します。よろしくお願いします。',
            'url' => 'http://localhost:8888',
        ]);
        DB::table('submissions')->insert([
            'user_id' => 7,
            'category' => 'Java1',
            'lesson_name' => '演習問題1',
            'comment' => '提出します。よろしくお願いします。',
            'url' => 'http://localhost:8888',
        ]);
        DB::table('submissions')->insert([
            'user_id' => 7,
            'category' => 'Java1',
            'lesson_name' => '演習問題2',
            'comment' => '提出します。よろしくお願いします。',
            'url' => 'http://localhost:8888',
        ]);
        DB::table('submissions')->insert([
            'user_id' => 7,
            'category' => 'Java1',
            'lesson_name' => '演習問題3',
            'comment' => 'コメント',
            'url' => 'http://localhost:8888',
        ]);
        DB::table('submissions')->insert([
            'user_id' => 7,
            'category' => 'DB',
            'lesson_name' => '演習問題1',
            'comment' => 'コメント',
            'url' => 'http://localhost:8888',
        ]);
        DB::table('submissions')->insert([
            'user_id' => 8,
            'category' => 'Java1',
            'lesson_name' => '演習問題1',
            'comment' => 'コメント',
            'url' => 'http://localhost:8888',
        ]);
        DB::table('submissions')->insert([
            'user_id' => 8,
            'category' => 'Java1',
            'lesson_name' => '単元課題1',
            'comment' => '遅れました。',
            'url' => 'http://localhost:8888',
        ]);
        DB::table('submissions')->insert([
            'user_id' => 10,
            'category' => 'DB',
            'lesson_name' => '演習問題1',
            'comment' => 'コメント',
            'url' => 'http://localhost:8888',
        ]);
        DB::table('submissions')->insert([
            'user_id' => 10,
            'category' => 'Java1',
            'lesson_name' => '単元課題1',
            'comment' => '遅れました。',
            'url' => 'http://localhost:8888',
        ]);
        DB::table('submissions')->insert([
            'user_id' => 12,
            'category' => 'DB',
            'lesson_name' => '演習問題1',
            'comment' => 'コメント',
            'url' => 'http://localhost:8888',
        ]);
        DB::table('submissions')->insert([
            'user_id' => 12,
            'category' => 'Java1',
            'lesson_name' => '単元課題1',
            'comment' => '遅れました。',
            'url' => 'http://localhost:8888',
        ]);
    }
}
