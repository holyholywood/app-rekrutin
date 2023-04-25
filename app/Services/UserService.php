<?php

namespace App\Services;

use App\Repositories\UserRepository;

class UserService
{
    private $User;

    public function __construct()
    {
        $this->User = new UserRepository();
    }

    public function getAllUser($selector = null)
    {
        return $this->User->get($selector);
    }
}
