<?php

use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Setting::create([
            'company_name' =>'Novartis',
            'event_name' =>'imaging-atelier',
            'address' =>'Dubai Marina',
            'lat' =>'25.276987',
            'lng' =>'55.296249'
        ]);
    }
}
