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
        ];
        $categories[] = [
            "title" => "Web-разработка",
        ];
        $categories[] = [
            "title" => "Математика",
        ];
        $categories[] = [
            "title" => "Информатика",
        ];
        $categories[] = [
            "title" => "Общественные науки",
        ];

        DB::table('categories')->insert($categories);
    }
}
