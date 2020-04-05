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

        for ($i=1; $i < 80; $i++) { 
            $title = 'Модуль '.$i. " Lorem ipsum dolor sit cumque";
            $author_id = rand(1,12);
            $modules[] = [
                'title' => $title,
                'author_id' => $author_id,
            ];
        };

        DB::table('modules')->insert($modules);
    }
}
