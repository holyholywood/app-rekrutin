<?php

namespace App\Repositories;

use App\Models\Message;
use Error;
use Illuminate\Support\Facades\Auth;

class MessageRepository
{
    public function get()
    {
        return Message::where('sender_id', Auth::id())->orWhere('receiver_id', Auth::id())->orderBy('created_at', 'ASC')->get();
    }

    public function getConversation($receiver_id = null)
    {
        Message::latest('created_at')->first()->update([
            'is_read' => 1,
        ]);

        return Message::where(['receiver_id' => Auth::id(), 'sender_id' => $receiver_id])->orWhere(['receiver_id' => $receiver_id, 'sender_id' => Auth::id()])->orderBy('created_at', 'ASC')->get();
    }

    public function getNotificationCount()
    {
        return Message::where('receiver_id', Auth::id())->where('is_read', 0)->count();
    }

    public function save($data = null)
    {
        if (!$data) {
            throw new Error('data is required');
        }

        return  Message::create($data);
    }

    public function delete($selector)
    {
        return Message::where($selector['fieldName'], $selector['value'])->delete();
    }
}
