<?php

use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            [
                "title" => "Пользователь",
                "title_en" => "User",
            ],
            [
                "title" => "Администратор",
                "title_en" => "Administrator",
            ],
            [
                "title" => "Модератор",
                "title_en" => "Moderator",
            ],
        ];

       
        DB::table('roles')->insert($roles);
    }
}
