<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tees', function (Blueprint $table) {
        
            $table->bigIncrements('id');
            $table->string('colour');
        
            $table->float('rating', 5, 2);;
            $table->float('slope',5,2);

            $table->unsignedInteger('course_id');
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
        Schema::dropIfExists('tees');
    }
}
