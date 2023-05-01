<?php

namespace App\Services;

use App\Repositories\ConversationRepository;
use App\Services\MessageService;

class ConversationService
{
    private $Conversation;
    private $ServiceMessage;

    public function __construct()
    {
        $this->Conversation = new ConversationRepository();
        $this->ServiceMessage = new MessageService();
    }

    public function getConversationList()
    {
        return $this->Conversation->getList();
    }
    public function getConversation($partner_id)
    {
        return $this->Conversation->get($partner_id);
    }

    public function create($data)
    {
        return $this->Conversation->create($data);
    }
}
