<?php

use Illuminate\Database\Seeder;

class AnswerTestSectionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $answers = [];
        for ($i=1; $i < 21; $i++) { 
            $answers[] = [
                'test_section_id'=>$i,
                'value'=>"Первый ответ",
                'correct'=>1,
            ];
            $answers[] = [
                'test_section_id'=>$i,
                'value'=>"Второй ответ",
                'correct'=>0,
            ];
        }
        
        DB::table('answer_test_sections')->insert($answers);
    }
}
