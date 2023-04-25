<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Http\Response\ResponseTraits;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    use ResponseTraits;

    public function index(UserService $Service)
    {
        return $this->sendResponse($Service->getAllUser());
    }

    public function show(UserService $Service, Request $request)
    {
        return $this->sendResponse($Service->getAllUser(['fieldName' => 'id', 'value' => $request->id]));
    }

    public function showUser()
    {
        $user = Auth::user();

        return $this->sendResponse($user);
    }
}
