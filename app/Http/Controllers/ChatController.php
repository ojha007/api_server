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
            ->selectRaw('max(id) as id')
            ->groupBy('chat_id');
        $a = DB::table('chat_messages as chatMessages')
            ->select('message', 'identifier')
            ->selectRaw('TIMESTAMPDIFF(MINUTE, chatMessages.created_at, NOW()) as time')
            ->joinSub($latestChat, 'messages', 'chatMessages.id', '=', 'messages.id')
            ->join('chats', 'chats.id', 'chatMessages.chat_id')
            ->whereNull('chatMessages.deleted_at')
            ->orderByDesc('chatMessages.created_at')
            ->offset($offset)
            ->limit($limit)
            ->get();
        return new SuccessResponse($a);
    }

    public function getOldChats(Request $request): SuccessResponse
    {
        $limit = $request->get('limit') ?? 10;
        $offset = $request->get('offset') ?? 0;
        $chats = DB::table('chat_messages as cm')
            ->select('message')
            ->selectRaw('CASE WHEN admin_id is not null then "right" end as class')
            ->selectRaw('CASE WHEN admin_id is  null then "Customer" else "You" end as type')
            ->join('chats', 'chats.id', 'cm.chat_id')
            ->where('chats.identifier', $request->get('identifier'))
            ->whereNull('cm.deleted_at')
            ->orderBy('cm.created_at')
            ->offset($offset)
            ->limit($limit)
            ->get();
        return new SuccessResponse($chats);
    }
}
