<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'id' => 1,
            'name' => 'Admin',
            'email' => 'admin@leaseweb.com',
            'password' => bcrypt('password'),
            'is_admin' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('users')->insert([
            'id' => 2,
            'name' => 'manager',
            'email' => 'manager@leaseweb.com',
            'password' => bcrypt('password'),
            'is_admin' => 0,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
