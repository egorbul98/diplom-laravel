<?php

use Illuminate\Database\Seeder;

class ModuleSectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items= [];
        $section_id = 1;
        $course_id = 1;
        $items[] = [
            "module_id" => 1,
            "section_id" => $section_id,
            "course_id" => $section_id,
        ];
        $items[] = [
            "module_id" => 2,
            "section_id" => $section_id,
            "course_id" => $section_id,
        ];
        $items[] = [
            "module_id" => 3,
            "section_id" => $section_id,
            "course_id" => $section_id,
        ];
        
        for ($i=2; $i < 150; $i++) { 
            $section_id = rand(2, 30);
            $module_id = rand(2, 60);
            $course_id = rand(2, 20);
            $items[] = [
                "module_id" => $module_id,
                "section_id" => $section_id,
                "course_id" => $section_id,
            ];
        };

        DB::table('module_section')->insert($items);
    }
}
