<?php

namespace App\Repositories;

use App\Models\Message;
use Error;
use Illuminate\Support\Facades\Auth;

class MessageRepository
{
    public function get($receiver_id = null)
    {
        if (!$receiver_id) {
            throw new Error('receiver_id is required');
        }

        return Message::where('receiver_id', $receiver_id)->where('sender_id', Auth::id())->orderBy('created_at', 'ASC')->get();
    }

    public function save($data = null)
    {
        if (!$data) {
            throw new Error('data is required');
        }

        Message::create($data);

        return Message::where('receiver_id', $data['receiver_id'])->where('sender_id', Auth::id())->orderBy('created_at', 'ASC')->get()->fresh();
    }

    public function delete($selector)
    {
        return Message::where($selector['fieldName'], $selector['value'])->delete();
    }
}
