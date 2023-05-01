<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMessageRequest;
use App\Http\Response\ResponseTraits;
use App\Models\Conversation;
use App\Models\Message;
use App\Services\ConversationService;
use App\Services\MessageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Throwable;

class MessageController extends Controller
{
    use ResponseTraits;

    public function __construct()
    {
        $this->middleware('auth:api');
    }


    /**
     ** get My Message 
     */
    public function myMessage(ConversationService $Service)
    {
        return  $this->sendResponse($Service->getConversationList());
    }
    /**
     ** get My Message With interlocutors
     */
    public function myMessageWith(ConversationService $Service, Request $request)
    {
        return  $this->sendResponse($Service->getConversation($request->interlocutors_id));
    }
    /**
     ** get My Unread Message
     */
    public function showNotificationCount(MessageService $Service)
    {
        return  $this->sendResponse('test');
    }
    /**
     ** Send Message to interlocutors 
     */
    public function send(ConversationService $Service, StoreMessageRequest $request)
    {

        return $this->sendResponse($Service->create($request->all()), 201);
    }
}
