<?php

namespace App\Http\Controllers;

use App\Http\Responses\SuccessResponse;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChatController extends Controller
{

    public function replyToMessage(Request $request): SuccessResponse
    {

        $message = new Message();
        $message->user_id = Auth::user()->id;
        $message->identifier = $request->get('identifier');
        $message->customer_id = $request->get('customer_id');
        $message->message = $request->message;
        $message->save();
        return new SuccessResponse();
    }

    public function getAllChats(Request $request): SuccessResponse
    {
        $limit = $request->get('limit') ?? 10;
        $offset = $request->get('offset') ?? 0;
        $latestChat = DB::table('chat_messages')
            ->max('id')
            ->groupBy('chat_id');
        $a =  DB::table('chat_messages as chatMessages')
            ->select('message', 'identifier',)
            ->joinSub($latestChat, 'messages', 'chatMessages.id', '=', 'messages.id')
            ->join('chats', 'chat.id', 'chatMessages.chat_id')
            ->offset($offset)
            ->limit($limit)
            ->toSql();
        return new SuccessResponse($a);
    }
}
