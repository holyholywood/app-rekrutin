<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Http\Requests\StoreMessageRequest;
use App\Http\Requests\UpdateMessageRequest;
use App\Http\Response\ResponseTraits;
use App\Services\MessageService;
use Illuminate\Http\Request as HttpRequest;

class MessageController extends Controller
{
    use ResponseTraits;

    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(MessageService $Service, HttpRequest $request)
    {
        return $this->sendResponse($Service->getMessage(1));
    }

    public function userMessageList()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MessageService $Service, StoreMessageRequest $request)
    {
        return $this->sendResponse($Service->createNewMessage($request->all()), 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Message $message)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMessageRequest $request, Message $message)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Message $message)
    {
        //
    }
}
