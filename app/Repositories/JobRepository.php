<?php

namespace App\Repositories;

use App\Models\Job;

class JobRepository
{
    public function get($selector = null)
    {
        if (!$selector) {
            return Job::all();
        }
        return Job::where($selector['fieldName'], $selector['value'])->first();
    }

    public function save($data, $selector = null)
    {
        if (!$selector) {
            return Job::create($data);
        }

        Job::where($selector['fieldName'], $selector['value'])->update($data);
        //send back the data
        return Job::where($selector['fieldName'], $selector['value'])->first()->fresh();
    }

    public function delete($selector)
    {
        return Job::where($selector['fieldName'], $selector['value'])->delete();
    }
}
