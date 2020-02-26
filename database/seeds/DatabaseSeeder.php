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
         $this->call(UserSeeder::class);
         $this->call(PollSeeder::class);
         $this->call(AgendaSeeder::class);
         $this->call(SettingSeeder::class);
         $this->call(AgendaRateQuestion::class);
    }
}
