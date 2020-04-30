<?php

use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [];
        $categories[] = [
            "title" => "Программирование",
            "title_en" => "Programming",
            "slug" => "programming",
        ];
        $categories[] = [
            "title" => "Web-разработка",
            "title_en" => "Web-development",
            "slug" => "web-development",
        ];
        $categories[] = [
            "title" => "Математика",
            "title_en" => "Mathematics",
            "slug" => "mathematics",
        ];
        $categories[] = [
            "title" => "Информатика",
            "title_en" => "Informatics",
            "slug" => "informatics",
        ];
        $categories[] = [
            "title" => "Общественные науки",
            "title_en" => "Social-sciences",
            "slug" => "social-sciences",
        ];

        DB::table('categories')->insert($categories);
    }
}
