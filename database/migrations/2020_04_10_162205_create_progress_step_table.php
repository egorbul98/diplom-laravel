<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProgressStepTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('progress_step', function (Blueprint $table) {
            $table->integer("step_id");
            $table->integer("user_id");
            $table->integer("course_id");
            $table->integer("module_id");
            $table->integer("section_id");
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
        Schema::dropIfExists('progress_step');
    }
}
