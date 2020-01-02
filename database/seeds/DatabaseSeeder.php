<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'gmedia@gmail.com',
            'password' => bcrypt('123@123'),
            'status' => 1,
        ]);
    }
}
