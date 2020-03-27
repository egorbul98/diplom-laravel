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
        ];
        $stype[] = [
            'title'=>"Задача с текстовым ответом",
            'description'=>"Есть поле для текстового ответа"
        ];
        $stype[] = [
            'title'=>"Числовая задача",
            'description'=>"Есть поле для числового ответа"
        ];

        DB::table('step_types')->insert($stype);
    }
}
