<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('assign_subjecjs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('class_id');
            $table->unsignedBigInteger('subject_id');
            $table->unsignedBigInteger('as_create_by');
            $table->integer('as_status');
            $table->integer('as_delete');
            $table->timestamps();

            $table->foreign('class_id')->references('id')->on('class_rooms');
            $table->foreign('subject_id')->references('id')->on('subjects');
            $table->foreign('as_create_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assign_subjecjs');
    }
};
