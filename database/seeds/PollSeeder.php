<?php

use App\Poll;
use Illuminate\Database\Seeder;

class PollSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arrayData = [
            [
                'title'=>'poll 1',
            ],[
                'title'=>'poll 2',
            ],
        ];
        foreach ($arrayData as $i => $data)
        {
            $poll =Poll::create($data);
            $poll->options()->create([
                'option'=>'option '.$i,
            ]);
        }
    }
}
