<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('companies')->insert([
            'name' => 'T&Cテクノロジーズ株式会社',
            'short_name' => 'T&C',
        ]);
        DB::table('companies')->insert([
            'name' => '株式会社OSE',
            'short_name' => 'OSE',
        ]);
        DB::table('companies')->insert([
            'name' => '株式会社テクノコア',
            'short_name' => 'テクノコア',
        ]);
        DB::table('companies')->insert([
            'name' => '株式会社琉球ネットワークサービス',
            'short_name' => 'RNS',
        ]);
    }
}
