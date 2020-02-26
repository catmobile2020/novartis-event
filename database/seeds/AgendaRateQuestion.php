<?php

use Illuminate\Database\Seeder;

class AgendaRateQuestion extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $questionsArray = [
            ['title'=>'How well did this educational event improve your knowledge?','type'=>1],
            ['title'=>'How likely are you to apply the knowledge from this educational program to your clinical practice?','type'=>1],
            ['title'=>'How likely would you recommend this educational offering to a peer?','type'=>1],
            ['title'=>'Did the program meet the stated educational objectives?','type'=>1],
            ['title'=>'Please rate the overall quality of the content of the presentations.','type'=>1],
            [
                'title'=>'Reason for attending the meeting',
                'type'=>2,
            ],
        ];
        $optionsArray = [
            'To learn more about imaging',
            'To learn more about disease control',
            'To share your own experience',
            'To hear presentations and opinions from international and local experts',
        ];
        foreach ($questionsArray as $que)
        {
            $question = \App\AgendaRateQuestions::create($que);
            if ($que['type'] == 2)
            {
                foreach ($optionsArray as $opt)
                {
                    $question->options()->create(['option'=>$opt]);
                }
            }
        }
    }
}
