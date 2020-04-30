<?php

use Illuminate\Database\Seeder;

class StatusesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $statuses = [];
        $statuses[] = [
            "title" => "Курс в разработке",
            "title_en" => "Course in development",
        ];
        $statuses[] = [
            "title" => "Курс в ожидании публикации",
            "title_en" => "Course pending publication",
        ];
        $statuses[] = [
            "title" => "Курс опубликован",
            "title_en" => "Course published",
        ];
       
        DB::table('statuses')->insert($statuses);
    }
}
