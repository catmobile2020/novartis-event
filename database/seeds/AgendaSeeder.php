<?php

use Illuminate\Database\Seeder;

class AgendaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $daysArray = [
            ['date'=>'2020-02-20'],
            ['date'=>'2020-02-21'],
        ];
        foreach ($daysArray as $row)
        {
            $day =\App\Day::create($row);
            $day->sessions()->create([
                'title' => 'test',
                'location' => 'Hal 1',
                'time_from' => '09:00:00',
                'time_to' => '09:30:00',
            ]);
        }
    }
}
