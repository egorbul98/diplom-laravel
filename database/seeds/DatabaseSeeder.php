<?php

use App\Models\Competence;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CoursesSeeder::class);
        $this->call(UsersSeeder::class);
        $this->call(SectionsSeeder::class);
        $this->call(ModulesSeeder::class);
        $this->call(CategoriesSeeder::class);
        $this->call(CompetencesSeeder::class);
        $this->call(CompetenceModuleSeeder::class);
        $this->call(StepTypesSeeder::class);
        $this->call(ModuleSectionSeeder::class);
        // factory(\App\Post::class, 100)->create();
    }
}
