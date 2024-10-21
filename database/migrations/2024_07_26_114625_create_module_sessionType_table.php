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
        Schema::create('module_sessionType', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sessionType_id')->constrained();;
            $table->foreignId('module_id')->constrained();;
            // $table->foreign('sessionType_id')->onDelete('cascade');
            // $table->foreign('module_id')->onDelete('cascade');
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
        Schema::dropIfExists('module_sessionType');
    }
};
