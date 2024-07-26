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
        Schema::create('study', function (Blueprint $table) {
            $table->bigIncrements('study_id');
            $table->unsignedBigInteger('session_id');
            $table->unsignedBigInteger('group_teaching_id');
            $table->foreign('session_id')->references('session_id')->on('sessions')->onDelete('cascade');
            $table->foreign('group_teaching_id')->references('group_teaching_id')->on('gr_teaching')->onDelete('cascade');
        
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
        Schema::dropIfExists('study');
    }
};
