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
        Schema::create('courses', function($table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('title');
            $table->text('description');
            $table->text('requirements')->nullable();
            $table->string('avatar');
            $table->decimal('price')->unsigned();
            $table->decimal('duration')->unsigned();
            $table->decimal('discount')->unsigned()->nullable();
            $table->boolean('active')->default(1);
            $table->string('discount_type', 7)->nullable();
            $table->bigInteger('category_id')->unsigned();
            $table->bigInteger('instructor_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('category_id')->references('id')->on('categories');
            $table->foreign('instructor_id')->references('id')->on('users');
            $table->foreign('user_id')->references('id')->on('users');
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
