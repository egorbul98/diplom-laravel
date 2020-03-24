<?php

use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $name = "Без категории";
        $categories[] = [
            'name' => $name,
            "parent_id"=> 0,
            "description" => "Это самая главная категория, от которой наследуются все категории",
            "slug" => Str::slug($name)
        ];

        for ($i=1; $i < 11; $i++) { 
            $nameCat = 'Категория '.$i;
            $parentId = ($i>4) ? rand(1,4) : 1;

            $categories[] = [
                'name' => $nameCat,
                "parent_id"=> $parentId,
                "description" => "Описание {$nameCat} . Его родительская категория с id = '{$parentId}'",
                "slug" => Str::slug($nameCat)
            ];
        };

        DB::table('categories')->insert($categories);
    }
}
