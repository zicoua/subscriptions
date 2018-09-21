<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\User::firstOrCreate(['email' => 'admin@example.com'],
            [
                'name'     => 'Admin',
                'password' => bcrypt('password')
            ]);
    }
}
