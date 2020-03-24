<?php

use Illuminate\Database\Seeder;

class ModulesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $modules= [];

        for ($i=1; $i < 60; $i++) { 
            $sectionId = rand(1,30);
            $title = 'Модуль '.$i. " Lorem ipsum dolor sit cumque";
            
            $modules[] = [
                'title' => $title,
                "section_id"=> $sectionId,
            ];
        };

        DB::table('modules')->insert($modules);
    }
}
