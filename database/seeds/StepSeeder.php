<?php

use Illuminate\Database\Seeder;

class StepSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $steps = [];
        $steps[] = [
            'module_id'=>1,
            'content'=>"content asdsa sad asd",
            'step_type_id'=> 1,
        ];
        $steps[] = [
            'module_id'=>1,
            'content'=>"content asdsa sad asd",
            'step_type_id'=> 1,
        ];
        $steps[] = [
            'module_id'=>2,
            'content'=>"content asdsa sad asd",
            'step_type_id'=> 1,
        ];
        $steps[] = [
            'module_id'=>3,
            'content'=>"content asdsa sad asd",
            'step_type_id'=> 1,
        ];

        DB::table('steps')->insert($steps);
    }
}
