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
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('job_id');
            $table->unsignedBigInteger('applicants_id');
            $table->bigInteger('salary_expectation');
            $table->string('cv_url', 500);
            $table->enum('status', [
                'documents',
                'hr_interview',
                'user_interview',
                'announcement',
                'announced'
            ])->default('documents');
            $table->timestamps();


            $table->foreign('applicants_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
            $table->foreign('job_id')
                ->references('id')
                ->on('jobs')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applications');
    }
};
