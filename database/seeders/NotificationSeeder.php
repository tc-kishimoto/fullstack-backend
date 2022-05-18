<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NotificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('notifications')->insert([
            'source_user_id' => 1,
            'target_user_id' => 1,
            'target_table' => 'submissions',
            'target_id' => 1,
            'conent' => 'Adminさんが演習問題1を提出しました。',
            'status' => 0,
        ]);
        DB::table('notifications')->insert([
            'source_user_id' => 1,
            'target_user_id' => 1,
            'target_table' => 'submissions',
            'target_id' => 2,
            'conent' => 'Adminさんが演習問題2を提出しました。',
            'status' => 0,
        ]);
        DB::table('notifications')->insert([
            'source_user_id' => 1,
            'target_user_id' => 1,
            'target_table' => 'submissions',
            'target_id' => 3,
            'conent' => 'Adminさんが演習問題3を提出しました。',
            'status' => 0,
        ]);
    }
}
