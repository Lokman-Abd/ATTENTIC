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
        Schema::create('module_sessionType_teacher', function (Blueprint $table) {
            $table->id();
            $table->foreignId('module_sessionType_id')->constrained(table: 'module_sessionType');
            $table->foreignId('teacher_id')->constrained();
            // $table->foreign('module_sessionType_id')->onDelete('cascade');
            // $table->foreign('teacher_id')->onDelete('cascade');
        
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
        Schema::dropIfExists('module_sessionType_teacher');
    }
};
