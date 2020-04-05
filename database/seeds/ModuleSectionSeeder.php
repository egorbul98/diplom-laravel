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
        
        for ($i=1; $i < 150; $i++) { 
            $section_id = rand(1, 30);
            $module_id = rand(1, 60);
            $items[] = [
                "module_id" => $module_id,
                "section_id" => $section_id,
            ];
        };

        DB::table('module_section')->insert($items);
    }
}
