<?php

namespace App\Repositories;

use App\Models\Conversation;
use App\Models\Message;
use Error;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Throwable;

class ConversationRepository
{
    private $MessageRepository;
    public function __construct()
    {
        $this->MessageRepository = new MessageRepository();
    }
    public function getList()
    {
        $conversations = Conversation::select('conversations.*', 'messages.body as last_message')
            ->where(['conversations.receiver_id' => Auth::id()])->orWhere(['conversations.sender_id' => Auth::id()])
            ->join(DB::raw('(SELECT MAX(created_at) as latest_date, conversations_id FROM messages GROUP BY conversations_id) latest_messages'), function ($join) {
                $join->on('conversations.id', '=', 'latest_messages.conversations_id');
            })
            ->join('messages', function ($join) {
                $join->on('messages.conversations_id', '=', 'conversations.id')
                    ->on('messages.created_at', '=', 'latest_messages.latest_date');
            })
            ->get();
        return $conversations;
    }
    public function get($partner_id)
    {
        return Message::where(['receiver_id' => Auth::id(), 'sender_id' => $partner_id])->orWhere(['receiver_id' => $partner_id, 'sender_id' => Auth::id()])->orderBy('created_at', 'ASC')->get();
    }

    public function create($data)
    {

        list('title' =>  $title, 'body' => $body) = $data;
        $receiver_id = (int) $data['receiver_id'];
        $sender_id  = Auth::id();

        /**
         * *Prepare  Message Data
         */
        $MessageData = ['title' =>  $title, 'body' => $body, 'receiver_id' => $receiver_id];
        $MessageData['sender_id'] = $sender_id;
        /**
         * *Check if conversation exist
         */
        DB::beginTransaction();
        try {
            $isConversationExist = Conversation::where(['receiver_id' => $receiver_id, 'sender_id' => $sender_id])->orWhere(['receiver_id' => $sender_id, 'sender_id' => $receiver_id])->first();


            if ($isConversationExist) {
                /**
                 * *add conversation id
                 */
                $MessageData['conversations_id'] = $isConversationExist['id'];

                /**
                 * *Store  Conversation Data when conversation  exist
                 */
                $Message =  $this->MessageRepository->save($MessageData);

                DB::commit();

                return  $Message;
            }
            /**
             * *Prepare  Conversation Data
             */
            $dataConversation = [
                'sender_id' => $sender_id,
                'receiver_id' => $receiver_id,
                'is_read' => 0
            ];


            /**
             * *Store  Conversation Data
             */
            $storedConversation = Conversation::create($dataConversation);

            /**
             * *add conversation id
             */
            $MessageData['conversations_id'] = $storedConversation['id'];


            /**
             * *Store  Conversation Data when conversation not exist
             */
            $Message = $this->MessageRepository->save($MessageData);

            DB::commit();
            return $Message;
        } catch (Throwable $err) {

            DB::rollBack();
            return $err->getMessage();
        }
    }
}
