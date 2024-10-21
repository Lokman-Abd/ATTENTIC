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
        Schema::create('justifications', function (Blueprint $table) {
            $table->bigIncrements('justification_id');
            $table->foreignId('student_id')->constrained();
            $table->string('img_path');
            $table->enum('justification_status',['accepted','refused','unseen'])->default('unseen');
            $table->dateTime('start_at');
            $table->dateTime('end_at');
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
        Schema::dropIfExists('justifications');
    }
};
