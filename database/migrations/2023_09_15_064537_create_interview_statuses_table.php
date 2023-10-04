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
        Schema::create('interview_statuses', function (Blueprint $table) {
            $table->id('status_id');
            $table->unsignedBigInteger('interview_id');
            $table->string('group');
            // Add any other columns you need

            $table->timestamps();

            // Define the foreign key constraint
            $table->foreign('interview_id')->references('interview_id')->on('interviews')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('interview_statuses');
    }
};
