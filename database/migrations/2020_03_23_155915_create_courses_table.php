<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string("title");
            $table->text("description");
            $table->text("content");
            $table->string("slug");
            $table->integer("category_id");
            $table->integer("author_id");
            $table->tinyInteger("status_id")->default(1);
            
            $table->string("title_en")->nullable();
            $table->text("description_en")->nullable();
            $table->text("content_en")->nullable();
           
            $table->string("image")->nullable();
            
            $table->tinyInteger("knowledge_to_repeat")->default(40);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('courses');
    }
}
