<?php

use Illuminate\Database\Seeder;

class CompetencesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $competences= [];
        $competences[] = [
            'title' => 'Выходной из первого',
            "section_id"=> 1,
        ];
        $competences[] = [
            'title' => 'Выходной из второго',
            "section_id"=> 1,
        ];
        $competences[] = [
            'title' => 'Выходной из третьего',
            "section_id"=> 1,
        ];

        for ($i=2; $i < 30; $i++) { 
            $sectionId = $i;
            $competences[] = [
                'title' => 'Умение читать',
                "section_id"=> $sectionId,
            ];
            $competences[] = [
                'title' => 'Умение писать',
                "section_id"=> $sectionId,
            ];
            $competences[] = [
                'title' => 'Умение уметь делать',
                "section_id"=> $sectionId,
            ];
            $competences[] = [
                'title' => 'Знание таблицы умшножения',
                "section_id"=> $sectionId,
            ];
            $competences[] = [
                'title' => 'Навык чтения про себя',
                "section_id"=> $sectionId,
            ];
            $competences[] = [
                'title' => 'Знание того, что полезно в данный момент времени',
                "section_id"=> $sectionId,
            ];
            $competences[] = [
                'title' => 'Знание чего-нибудь',
                "section_id"=> $sectionId,
            ];
        };

        DB::table('competences')->insert($competences);
    }
}
