<?php

use Illuminate\Database\Seeder;

class CoursesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $courses= [];
        $categoryId = rand(1,5);
        $authorId = 3;
        $title = 'Курс для тех, кто что-то там';
        $image = "main/img/course.jpg";
        $courses[] = [
            'title' => $title,
            "category_id"=> $categoryId,
            "author_id"=> $authorId,
            "image"=>$image,
            "description" => "Описание {$title} . Его категория с id = '{$categoryId}'",
            "slug" => Str::slug($title),
            "content" => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Sed at cumque doloribus, delectus laboriosam quibusdam ea debitis commodi autem eum iure reprehenderit sapiente fugiat, saepe totam sint cum, natus minus eveniet est tempore! Maiores corrupti voluptas inventore a. Culpa corrupti, consectetur ut ratione harum sapiente perferendis architecto! Earum, debitis officia omnis quaerat delectus consequatur quos rerum quibusdam nesciunt modi. Consequatur nostrum alias maxime ut asperiores sequi molestiae beatae eaque ratione iusto, adipisci, cum magnam blanditiis maiores. A dolor laboriosam id accusamus inventore fugit, laborum eaque nisi amet totam accusantium deleniti laudantium dignissimos consequatur nostrum reprehenderit! Fuga at non quam reprehenderit, dolore quae aperiam, iste magni ratione quasi eveniet rem facilis distinctio consequuntur ducimus. Pariatur quibusdam non cumque voluptatum animi accusantium, distinctio tempora a laudantium consequatur provident impedit. Veniam voluptate, quibusdam harum culpa, doloribus fugiat necessitatibus asperiores illum consequuntur autem vero! Reprehenderit sunt rem dolore totam cupiditate autem voluptatum corrupti quibusdam in dolorum laudantium, saepe consectetur eius qui, fugiat aut perferendis? Eos quidem harum nemo deserunt ullam itaque nesciunt inventore deleniti quae incidunt. Similique pariatur tenetur sequi accusamus, itaque voluptatum ullam quaerat asperiores neque error eos nemo voluptate, natus molestias atque at iusto qui eum. Quos totam laboriosam numquam fuga quam!"
        ];

        for ($i=2; $i < 20; $i++) { 
            $categoryId = rand(1,5);
            $authorId = ($i>4) ? rand(1,11) : 1;
            $title = 'Курс '.$i;
            $image = "main/img/course.jpg";
            $courses[] = [
                'title' => $title,
                "category_id"=> $categoryId,
                "author_id"=> $authorId,
                "image"=>$image,
                "description" => "Описание {$title} . Его категория с id = '{$categoryId}'",
                "slug" => Str::slug($title),
                "content" => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Sed at cumque doloribus, delectus laboriosam quibusdam ea debitis commodi autem eum iure reprehenderit sapiente fugiat, saepe totam sint cum, natus minus eveniet est tempore! Maiores corrupti voluptas inventore a. Culpa corrupti, consectetur ut ratione harum sapiente perferendis architecto! Earum, debitis officia omnis quaerat delectus consequatur quos rerum quibusdam nesciunt modi. Consequatur nostrum alias maxime ut asperiores sequi molestiae beatae eaque ratione iusto, adipisci, cum magnam blanditiis maiores. A dolor laboriosam id accusamus inventore fugit, laborum eaque nisi amet totam accusantium deleniti laudantium dignissimos consequatur nostrum reprehenderit! Fuga at non quam reprehenderit, dolore quae aperiam, iste magni ratione quasi eveniet rem facilis distinctio consequuntur ducimus. Pariatur quibusdam non cumque voluptatum animi accusantium, distinctio tempora a laudantium consequatur provident impedit. Veniam voluptate, quibusdam harum culpa, doloribus fugiat necessitatibus asperiores illum consequuntur autem vero! Reprehenderit sunt rem dolore totam cupiditate autem voluptatum corrupti quibusdam in dolorum laudantium, saepe consectetur eius qui, fugiat aut perferendis? Eos quidem harum nemo deserunt ullam itaque nesciunt inventore deleniti quae incidunt. Similique pariatur tenetur sequi accusamus, itaque voluptatum ullam quaerat asperiores neque error eos nemo voluptate, natus molestias atque at iusto qui eum. Quos totam laboriosam numquam fuga quam!"
            ];
        };

        DB::table('courses')->insert($courses);
    }
}
