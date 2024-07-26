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
        Schema::create('absences', function (Blueprint $table) {
            $table->bigIncrements('absence_id');
            $table->unsignedBigInteger('study_id');
            $table->unsignedBigInteger('student_id');
            $table->tinyInteger('status'); // Assuming 'status' is a tiny integer
            $table->foreign('study_id')->references('study_id')->on('study')->onDelete('cascade');
            $table->foreign('student_id')->references('student_id')->on('students')->onDelete('cascade');
        
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
        Schema::dropIfExists('absences');
    }
};
