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
        // group_module_sessionType_teacher_
        Schema::create('gr_mod_type_teacher', function (Blueprint $table) {
            $table->id();
            $table->foreignId('module_sessionType_teacher_id')->constrained(table: 'module_sessionType_teacher');
            $table->foreignId('group_id')->constrained();
            // $table->foreign('module_sessionType_teacher_id')->onDelete('cascade');
            // $table->foreign('group_id')->onDelete('cascade');
        
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
        Schema::dropIfExists('gr_mod_type_teacher');
    }
};
