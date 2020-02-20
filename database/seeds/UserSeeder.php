<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\User::create([
            'name' => 'admin',
            'email' => 'admin',
            'password' => 123456,
            'type' => 1
        ]);
        factory(\App\User::class,100)->create();
    }
}
