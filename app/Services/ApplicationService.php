<?php

namespace App\Services;

use App\Repositories\ApplicationRepository;
use Illuminate\Support\Facades\Auth;

class ApplicationService
{
    private $Application;

    public function __construct()
    {
        $this->Application = new ApplicationRepository();
    }

    public function getApplication($selector = null, $select = '*')
    {
        return $this->Application->get($selector, $select);
    }

    public function createNewApplication($data)
    {
        $data['applicants_id'] = Auth::user()->id;

        return $this->Application->save($data);
    }

    public function updateApplication($selector = null, $data)
    {

        $data['applicants_id'] = Auth::user()->id;

        return $this->Application->save($data, $selector);
    }

    public function deleteApplication($selector)
    {
        return $this->Application->delete($selector);
    }
}
