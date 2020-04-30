<?php

use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                "name" => "Петя",
                "lastname" => "Петров",
                "email" => "awdwad@mail.ru",
                "password"=>bcrypt(Str::random(16))
            ],
            [
                "name" => "Вася",
                "lastname" => "Вася",
                "email" => "vasi@mail.ru",
                "password"=>bcrypt("123123123")
            ],
            [
                "name" => "Егор",
                "lastname" => "Булахтин",
                "email" => "egorbul98@mail.ru",
                "password"=>bcrypt("123123123")
            ],
        ];

        for ($i=0; $i < 20; $i++) { 
            $name = "User {$i}";
            $lastname = "Lastnameser";
            $email = "vasi{$i}@mail.ru";
            $users[] = [
                "name" => $name,
                "lastname" => $lastname,
                "email" => $email,
                "password"=>bcrypt("123123123")
            ];
        }
        DB::table('users')->insert($users);
    }
}
