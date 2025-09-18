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
        Schema::create('feedbacks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('application_id')->constrained()->onDelete('cascade');
            $table->foreignId('job_id')->constrained()->onDelete('cascade');
            $table->foreignId('employer_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreignId('worker_id')->references('id')->on('users')->onDelete('cascade');
            $table->boolean('q1_punctual');
            $table->boolean('q2_satisfactory');
            $table->boolean('q3_professional');
            $table->boolean('q4_hire_again');
            $table->boolean('q5_fair_price');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('feedbacks');
    }
};
