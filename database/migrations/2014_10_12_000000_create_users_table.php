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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->string('firstName');
            $table->string('lastName');
            $table->string('password');
            $table->string('profile_picture')->default('https://ui-avatars.com/api/app');
            $table->date('birth_date')->nullable();
            $table->text('address')->nullable();
            $table->string('phone')->nullable();
            $table->string('default_cv_url', 500)->nullable();
            $table->enum('education_level', [
                'none',
                'elementary',
                'junior_high',
                'senior_high',
                'bachelor'
            ])->nullable()->default('none');
            $table->string('majors')->nullable();
            $table->enum('role', ['recruiter', 'applicant', 'user'])->default('applicant');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
