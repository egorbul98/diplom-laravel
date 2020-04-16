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
        $items[] = [
            "competence_id" => 1,
            "module_id" => 1,
            "type" => "out",
        ];
        $items[] = [
            "competence_id" => 1,
            "module_id" => 2,
            "type" => "in",
        ];
        $items[] = [
            "competence_id" => 2,
            "module_id" => 2,
            "type" => "out",
        ];
        $items[] = [
            "competence_id" => 2,
            "module_id" => 3,
            "type" => "in",
        ];
        $items[] = [
            "competence_id" => 3,
            "module_id" => 3,
            "type" => "out",
        ];



        // for ($i=1; $i < 150; $i++) { 
        //     $competence_id = rand(1, 100);
        //     $module_id = rand(4, 60);
        //     $type = (rand(1, 2) > 1) ? "in" : "out";
        //     $items[] = [
        //         "competence_id" => $competence_id,
        //         "module_id" => $module_id,
        //         "type" => $type,
        //     ];
        // };

        DB::table('competence_module')->insert($items);
    }
}
