<?php

use App\User;
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
         User::create([
             'name' => 'Admin',
             'email' => 'admin@test.com',
             'password' => Hash::make('password')
         ]);

        User::create([
            'name' => 'Editor',
            'email' => 'user@test.com',
            'password' => Hash::make('password')
        ]);
    }
}
