<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50);
            $table->date('birthday')->nullable();
            $table->string('address')->nullable();
            $table->string('phone', 10)->nullable();
            $table->text('email')->unique()->nullable();
            $table->tinyInteger('gender')->nullable();
            $table->string('image', 100)->nullable();
            $table->unsignedBigInteger('faculty_id')->nullable();
            $table->timestamps();

            $table->foreign('faculty_id')
                ->references('id')
                ->on('faculties')
                ->onDelete('cascade');;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students');
    }
}
