<?php

use Illuminate\Database\Seeder;

class TestsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tests = [];
        $tests[] = [
            'title'=>"Новый тест для тех кто что-то там",
            'author_id'=>3,
            'count_questions'=> 10,
            'description'=> "Описание йлоцвцй йц влйца йц даойц а йцдалой цджал цйов цйовдцйов дцйов дцйов э цйв цйв цйв цйв цйвйц вот так вот",
        ];
        
        DB::table('tests')->insert($tests);
    }
}
