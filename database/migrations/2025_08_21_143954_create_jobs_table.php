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
        Schema::create('jobs', function (Blueprint $table) {
            $table->id(); // primary key (job ID)
            
            $table->foreignId('user_id')
                  ->constrained()
                  ->onDelete('cascade'); 
            // employer ka user_id, agar user delete hoga to uski jobs bhi delete ho jayengi
            
            $table->string('title'); // job title
            $table->text('description'); // job details
            $table->string('category'); // job category
            $table->decimal('pay', 10, 2); // offered pay (eg. 1500.50)
            $table->dateTime('date_time'); // job ka time & date
            $table->string('duration'); // e.g. "3 hours", "2 days"
            $table->string('location'); // job location (Maps API later)
            $table->string('status')->default('open'); // open, completed
            $table->timestamps(); // created_at & updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jobs');
    }
};
