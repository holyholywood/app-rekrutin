<?php

namespace App\Services;

use App\Repositories\JobRepository;
use Illuminate\Support\Facades\Auth;

class JobService
{
    private $Job;

    public function __construct()
    {
        $this->Job = new JobRepository();
    }

    public function getJob($selector = null)
    {
        return $this->Job->get($selector);
    }

    public function createNewJob($data)
    {
        $data['recruiter_id'] = Auth::user()->id;

        return $this->Job->save($data);
    }

    public function updateJob($selector = null, $data)
    {

        $data['recruiter_id'] = Auth::user()->id;

        return $this->Job->save($data, $selector);
    }

    public function deleteJob($selector)
    {
        return $this->Job->delete($selector);
    }
}
