<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 1
        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'login_id' => 'admin',
            'role' => 1,
            'password' => Hash::make('admin'),
        ]);
        // 2
        DB::table('users')->insert([
            'name' => '岸本',
            'email' => 'kishimoto@gmail.com',
            'login_id' => 'kishimoto',
            'role' => 1,
            'password' => Hash::make('kishimoto'),
            'company_id' => 1, // T&C
        ]);
        // 3
        DB::table('users')->insert([
            'name' => 'T&C担当者',
            'email' => 'tantou1@gmail.com',
            'login_id' => 'tantou1',
            'role' => 2,
            'password' => Hash::make('tantou1'),
            'company_id' => 1, // T&C
        ]);
        // 4
        DB::table('users')->insert([
            'name' => 'RNS担当者',
            'email' => 'tantou2@gmail.com',
            'login_id' => 'tantou2',
            'role' => 2,
            'password' => Hash::make('tantou2'),
            'company_id' => 4, //

        ]);
        // 5
        DB::table('users')->insert([
            'name' => '沖縄 講師1',
            'email' => 'kousi1@gmail.com',
            'login_id' => 'kousi1',
            'role' => 3,
            'password' => Hash::make('kousi1'),
            'company_id' => 1, // T&C
        ]);
        // 6
        DB::table('users')->insert([
            'name' => '東京 講師21',
            'email' => 'kousi2@gmail.com',
            'login_id' => 'kousi2',
            'role' => 3,
            'password' => Hash::make('kousi2'),
            'company_id' => 3, //
        ]);
        // 7
        DB::table('users')->insert([
            'name' => '沖縄 研修生1',
            'email' => 'okinawa1@gmail.com',
            'login_id' => 'okinawa1',
            'role' => 4,
            'password' => Hash::make('okinawa1'),
            'company_id' => 1, //
        ]);
        // 8
        DB::table('users')->insert([
            'name' => '沖縄 研修生2',
            'email' => 'okinawa2@gmail.com',
            'login_id' => 'okinawa2',
            'role' => 4,
            'password' => Hash::make('okinawa2'),
            'company_id' => 1, //
        ]);
        // 9
        DB::table('users')->insert([
            'name' => '沖縄 研修生3',
            'email' => 'okinawa3@gmail.com',
            'login_id' => 'okinawa3',
            'role' => 4,
            'password' => Hash::make('okinawa3'),
            'company_id' => 1, //
        ]);
        // 10
        DB::table('users')->insert([
            'name' => '沖縄 研修生4',
            'email' => 'okinawa4@gmail.com',
            'login_id' => 'okinawa4',
            'role' => 4,
            'password' => Hash::make('okinawa4'),
            'company_id' => 4, // RNS

        ]);
        // 11
        DB::table('users')->insert([
            'name' => '沖縄 研修生5',
            'email' => 'okinawa5@gmail.com',
            'login_id' => 'okinawa5',
            'role' => 4,
            'password' => Hash::make('okinawa5'),
            'company_id' => 4, // RNS
        ]);
        // 12
        DB::table('users')->insert([
            'name' => '東京 研修生1',
            'email' => 'tokyo1@gmail.com',
            'login_id' => 'tokyo1',
            'role' => 4,
            'password' => Hash::make('tokyo1'),
            'company_id' => 3, // TC
        ]);
    }
}
