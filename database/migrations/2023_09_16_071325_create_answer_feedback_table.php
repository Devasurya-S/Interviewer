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
        Schema::create('answer_feedbacks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('employee_id');
            $table->unsignedBigInteger('interview_id');
            $table->text('question');
            $table->string('video_path');
            $table->text('feedback');
            $table->boolean('fb_view_status')->default(0)->comment('0 for not viewed by candidate, 1 for viewd by candidate');
            $table->boolean('fb_status')->default(0)->comment('0 for not feedbacked by employee, 1 for feedback done by employee');
            $table->string('candidate_name');
            $table->timestamps();
        
            // Define foreign key constraints without onDelete('cascade')
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
            $table->foreign('employee_id')->references('employee_id')->on('employees');
            $table->foreign('interview_id')->references('interview_id')->on('interviews');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('answer_feedback');
    }
};
