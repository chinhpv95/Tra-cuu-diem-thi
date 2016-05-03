<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('classes', function (Blueprint $table){
            $table->increments('id');
            $table->integer('year_id');
            $table->integer('semester_id');
            $table->char('class_name');
            $table->char('class_code');
            $table->char('email');
            $table->char('teacher');
            $table->char('link');
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
        Schema::drop('classes');
    }
}
