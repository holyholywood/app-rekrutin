<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Job extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'job_type',
        'location',
        'description',
        'salary_from',
        'salary_to',
        'fixed_salary',
        'recruiter_id',
        'due_date'
    ];
}
