<?php

use Illuminate\Database\Seeder;

class SectionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sections= [];

        for ($i=1; $i < 30; $i++) { 
            $courseId = rand(1,11);
            $title = 'Раздел '.$i. " Lorem ipsum dolor sit amet consectetur adipisicing";
            
            $sections[] = [
                'title' => $title,
                "course_id"=> $courseId,
                "description" => "Описание {$title}. Lorem ipsum dolor sit amet consectetur adipisicing elit. Sed at cumque doloribus, delectus laboriosam quibusdam ea debitis commodi autem eum iure reprehenderit sapiente fugiat, saepe totam sint cum, natus minus eveniet est tempore!",
            ];
        };

        DB::table('sections')->insert($sections);
    }
}
