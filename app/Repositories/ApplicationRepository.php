<?php

namespace App\Repositories;

use App\Models\Application;

class ApplicationRepository
{
    public function get($selector = null, $select = '*')
    {
        if (!$selector) {
            return Application::select($select)->get();
        }
        return Application::where($selector['fieldName'], $selector['value'])->select($select)->first();
    }

    public function save($data, $selector = null)
    {
        if (!$selector) {
            return Application::create($data);
        }

        Application::where($selector['fieldName'], $selector['value'])->update($data);
        //send back the data
        return Application::where($selector['fieldName'], $selector['value'])->first()->fresh();
    }

    public function delete($selector)
    {
        return Application::where($selector['fieldName'], $selector['value'])->delete();
    }
}
