<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'conversations_id',
        'title',
        'body',
        'sender_id',
        'receiver_id',
    ];


    public function conversation()
    {
        return $this->belongsTo(Conversation::class);
    }
}
