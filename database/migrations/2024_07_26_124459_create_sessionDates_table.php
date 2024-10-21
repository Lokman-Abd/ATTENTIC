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
        Schema::create('sessionDates', function (Blueprint $table) {
            $table->id();
            $table->dateTime('start_at');
            $table->dateTime('end_at');
            $table->foreignId('gr_mod_type_teacher_id')->constrained(table: 'gr_mod_type_teacher',);
            // All below foreign are repeated data but it was setted to prevent a big joins 
            $table->foreignId('group_id')->constrained();
            $table->foreignId('module_id')->constrained();
            $table->foreignId('sessionType_id')->constrained();
            $table->foreignId('teacher_id')->constrained();
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
        Schema::dropIfExists('sessionDates');
    }
};
