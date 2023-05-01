<?php

namespace App\Services;

use App\Models\Conversation;
use App\Models\Message;
use App\Repositories\MessageRepository;
use Error;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Throwable;

class MessageService
{
    private $Message;

    public function __construct()
    {
        $this->Message = new MessageRepository();
    }

    public function save($data, $conversation_id)
    {
    }
}
