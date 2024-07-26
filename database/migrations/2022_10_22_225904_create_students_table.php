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
        Schema::create('students', function (Blueprint $table) {
                $table->bigIncrements('student_id');
                $table->string('student_first_name');
                $table->string('student_last_name');
                $table->string('student_password');
                $table->string('student_email')->unique();
                $table->unsignedBigInteger('group_id');
                // $table->timestamps(); // Uncomment if you decide to use timestamps
    
                $table->foreign('group_id')->references('group_id')->on('groups')->onDelete('cascade');
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
};
