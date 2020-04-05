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
            "slug" => "programming",
        ];
        $categories[] = [
            "title" => "Web-разработка",
            "slug" => "web-development",
        ];
        $categories[] = [
            "title" => "Математика",
            "slug" => "mathematics",
        ];
        $categories[] = [
            "title" => "Информатика",
            "slug" => "informatics",
        ];
        $categories[] = [
            "title" => "Общественные науки",
            "slug" => "social-sciences",
        ];

        DB::table('categories')->insert($categories);
    }
}
