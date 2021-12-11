<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('role')->insert([
            'role' => 'user',
        ]);

        DB::table('role')->insert([
            'role' => 'company',
        ]);

        DB::table('role')->insert([
            'role' => 'admin',
        ]);

        DB::table('users')->insert([
            'first_name'        => 'Admin',
            'last_name'         => 'User',
            'username'          => 'admin',
            'email'             => 'user@user.com',
            'email_verified_at' => date('Y-m-d H:i:s'),
            'password'          => 'password',
            'role_id'           => 3,
        ]);
    }
}
