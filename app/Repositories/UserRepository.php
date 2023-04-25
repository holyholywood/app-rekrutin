<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository
{
    public function get($selector = null)
    {
        if (!$selector) {
            return User::all();
        }
        return User::where($selector['fieldName'], $selector['value'])->first();
    }
}
