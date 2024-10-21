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
            $table->id();
            $table->foreignId('sessionDate_id')->constrained();
            $table->foreignId('student_id')->constrained();
            $table->enum('status',['justifficated','injustificated'])->default('injustificated');
            // $table->foreign('sessionDate_id')->onDelete('cascade');
            // $table->foreign('student_id')->onDelete('cascade');
        
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
