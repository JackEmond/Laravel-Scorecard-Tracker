<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->bigIncrements('id');
            $table->string('course_name');
            $table->smallInteger('number_of_holes');
           
            $table->smallInteger('par_hole_one');
            $table->smallInteger('par_hole_two');
            $table->smallInteger('par_hole_three');
            $table->smallInteger('par_hole_four');
            $table->smallInteger('par_hole_five');
            $table->smallInteger('par_hole_six');
            $table->smallInteger('par_hole_seven');
            $table->smallInteger('par_hole_eight');
            $table->smallInteger('par_hole_nine');
            $table->smallInteger('par_hole_ten')->nullable();
            $table->smallInteger('par_hole_eleven')->nullable();
            $table->smallInteger('par_hole_twelve')->nullable();
            $table->smallInteger('par_hole_thirteen')->nullable();
            $table->smallInteger('par_hole_fourteen')->nullable();
            $table->smallInteger('par_hole_fifteen')->nullable();
            $table->smallInteger('par_hole_sixteen')->nullable();
            $table->smallInteger('par_hole_seventeen')->nullable();
            $table->smallInteger('par_hole_eighteen')->nullable();

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
