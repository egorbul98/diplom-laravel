<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProgressModuleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('progress_module', function (Blueprint $table) {
            $table->integer("module_id");
            $table->integer("user_id");
            $table->integer("course_id");
            $table->integer("section_id");
            // $table->string("repetition")->nullable();
            $table->dateTime("repetition")->nullable();//Дата следующего повторения
            $table->dateTime("completed_at")->nullable();//Дата прохождения
            $table->tinyInteger("complete")->default(0);
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('progress_module');
    }
}
