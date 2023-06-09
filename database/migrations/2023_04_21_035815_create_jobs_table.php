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
            $table->id();
            $table->string('title');
            $table->enum('job_type', ['remote', 'onsite', 'hybrid']);
            $table->string('location');
            $table->text('description');
            $table->bigInteger('salary_from');
            $table->bigInteger('salary_to');
            $table->bigInteger('fixed_salary');
            $table->unsignedBigInteger('recruiter_id');
            $table->dateTime('due_date');
            $table->timestamps();

            $table->foreign('recruiter_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
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
