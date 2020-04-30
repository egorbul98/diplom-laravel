<?php

use Illuminate\Database\Seeder;

class StepTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $stype = [];
        $stype[] = [
            'title'=>"Текст",
            'description'=>"Текст с форматированием, изображениями",
            'title_en'=>"Text",
            'description_en'=>"Text with formatting, images",
        ];
        $stype[] = [
            'title'=>"Задача с текстовым ответом",
            'description'=>"Есть поле для текстового ответа",
            'title_en'=>"Text Answer Task",
            'description_en'=>"There is a field for a text response"
        ];
        $stype[] = [
            'title'=>"Числовая задача",
            'description'=>"Есть поле для числового ответа",
            'title_en'=>"Numerical task",
            'description_en'=>"There is a field for a numerical answer"
        ];

        DB::table('step_types')->insert($stype);
    }
}
