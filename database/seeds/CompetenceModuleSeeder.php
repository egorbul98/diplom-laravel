<?php

use Illuminate\Database\Seeder;

class CompetenceModuleSeeder extends Seeder
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
            $competence_id = rand(1, 100);
            $module_id = rand(1, 60);
            $type = (rand(1, 2) > 1) ? "in" : "out";
            $items[] = [
                "competence_id" => $competence_id,
                "module_id" => $module_id,
                "type" => $type,
            ];
        };

        DB::table('competence_module')->insert($items);
    }
}
