<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // 一般ユーザー
        DB::table('users')->insert([
            'name' => '一般ユーザー',
            'email' => 'user@example.com',
            'password' => Hash::make('password'),
            'role' => 'user',
            'email_verified_at' => Carbon::now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // 店舗代表者
        DB::table('users')->insert([
            'name' => '店舗代表者',
            'email' => 'owner@example.com',
            'password' => Hash::make('password'),
            'role' => 'owner',
            'email_verified_at' => Carbon::now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // 管理者
        DB::table('users')->insert([
            'name' => '管理者',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'email_verified_at' => Carbon::now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
