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
        Schema::create('gr_teaching', function (Blueprint $table) {
            $table->bigIncrements('group_teaching_id');
            $table->unsignedBigInteger('teaching_id');
            $table->unsignedBigInteger('group_id');
            $table->foreign('teaching_id')->references('teaching_id')->on('teaching')->onDelete('cascade');
            $table->foreign('group_id')->references('group_id')->on('groups')->onDelete('cascade');
        
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
        Schema::dropIfExists('gr_teaching');
    }
};
