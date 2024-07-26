<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teaching', function (Blueprint $table) {
            $table->bigIncrements('teaching_id');
            $table->unsignedBigInteger('typing_id');
            $table->unsignedBigInteger('teacher_id');
            $table->foreign('typing_id')->references('typing_id')->on('typing')->onDelete('cascade');
            $table->foreign('teacher_id')->references('teacher_id')->on('teachers')->onDelete('cascade');
        
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
        Schema::dropIfExists('teaching');
    }
};
