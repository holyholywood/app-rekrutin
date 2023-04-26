<?php

namespace App\Services;

use App\Repositories\MessageRepository;
use Illuminate\Support\Facades\Auth;

class MessageService
{
    private $Message;

    public function __construct()
    {
        $this->Message = new MessageRepository();
    }

    public function getMessage($receiver_id = null)
    {
        return $this->Message->get($receiver_id);
    }

    public function createNewMessage($data)
    {
        $data['sender_id'] = Auth::id();

        return $this->Message->save($data);
    }

    public function updateMessage($selector = null, $data)
    {

        $data['recruiter_id'] = Auth::user()->id;

        return $this->Message->save($data, $selector);
    }

    public function deleteMessage($selector)
    {
        return $this->Message->delete($selector);
    }
}
