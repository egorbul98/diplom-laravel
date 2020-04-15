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
        $module_id = 1;
        $course_id = 1;
        $items[] = [
            "module_id" => $module_id,
            "section_id" => $section_id,
            "course_id" => $section_id,
        ];
        
        for ($i=1; $i < 150; $i++) { 
            $section_id = rand(1, 30);
            $module_id = rand(1, 60);
            $course_id = rand(1, 20);
            $items[] = [
                "module_id" => $module_id,
                "section_id" => $section_id,
                "course_id" => $section_id,
            ];
        };

        DB::table('module_section')->insert($items);
    }
}
