<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateScorecardTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scorecards', function (Blueprint $table) {
          
            $table->bigIncrements('id');
          
            $table->smallInteger('hole_one');
            $table->smallInteger('hole_two');
            $table->smallInteger('hole_three');
            $table->smallInteger('hole_four');
            $table->smallInteger('hole_five');
            $table->smallInteger('hole_six');
            $table->smallInteger('hole_seven');
            $table->smallInteger('hole_eight');
            $table->smallInteger('hole_nine');
            $table->smallInteger('hole_ten')->nullable();
            $table->smallInteger('hole_eleven')->nullable();
            $table->smallInteger('hole_twelve')->nullable();
            $table->smallInteger('hole_thirteen')->nullable();
            $table->smallInteger('hole_fourteen')->nullable();
            $table->smallInteger('hole_fifteen')->nullable();
            $table->smallInteger('hole_sixteen')->nullable();
            $table->smallInteger('hole_seventeen')->nullable();
            $table->smallInteger('hole_eighteen')->nullable();

            $table->date('date_played');

            $table->unsignedInteger('course_id');
            $table->unsignedInteger('tee_id');

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
        Schema::dropIfExists('scorecard');
    }
}
