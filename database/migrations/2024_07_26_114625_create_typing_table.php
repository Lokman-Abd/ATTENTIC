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
        Schema::create('typing', function (Blueprint $table) {
            $table->bigIncrements('typing_id');
            $table->unsignedBigInteger('type_id');
            $table->unsignedBigInteger('module_id');
            $table->foreign('type_id')->references('type_id')->on('types')->onDelete('cascade');
            $table->foreign('module_id')->references('module_id')->on('modules')->onDelete('cascade');
       
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
        Schema::dropIfExists('typing');
    }
};
