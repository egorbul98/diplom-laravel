<?php

use Illuminate\Database\Seeder;

class TestSectionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $test_sections = [];
        for ($i=1; $i < 21; $i++) { 
            $test_sections[] = [
                'test_id'=>1,
                'title'=>"Вопрос №".$i,
            ];
        }
        
        DB::table('test_sections')->insert($test_sections);
    }
}
