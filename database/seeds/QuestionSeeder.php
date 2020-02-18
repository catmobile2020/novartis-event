<?php

use App\Question;
use Illuminate\Database\Seeder;

class QuestionSeeder extends Seeder
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
                'question'=>'question 1',
                'user_id'=>1,
            ],[
                'question'=>'question 2',
                'user_id'=>1,
            ],
        ];
        foreach ($arrayData as $i => $data)
        {
            $question =Question::create($data);
        }
    }
}
