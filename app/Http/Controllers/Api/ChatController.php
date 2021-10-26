<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChatRequest;
use App\Http\Responses\ErrorResponse;
use App\Http\Responses\SuccessResponse;
use App\Models\Chat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChatController extends Controller
{

    public function getChat($identifier)
    {
        return Chat::where('user_id', '=', auth()->id())
            ->where('identifier', '=', $identifier)
            ->first();
    }

    public function chat(ChatRequest $request)
    {
        try {
            $identifier = $request->get('identifier');
            $chat = $this->getChat($identifier);
            if (!$chat) {
                $chat = Chat::create(['user_id' => auth()->id(), 'identifier' => $identifier]);
            }
            $chat->messages()->create([
                'message' => $request->get('message')
            ]);
            return new SuccessResponse();
        } catch (\Exception $exception) {
            return new ErrorResponse($exception);
        }
    }


    public function getAllChats(Request $request): SuccessResponse
    {
        $chats = DB::table('chats')
            ->select('message', 'admin_id', 'chat_messages.id')
            ->join('chat_messages', 'chats.id', '=', 'chat_messages.chat_id')
            ->whereNull('chat_messages.deleted_at')
            ->where('identifier', $request->get('identifier'))
            ->where('user_id', auth()->id())
            ->orderByDesc('chat_messages.updated_at')
            ->limit($request->get('limit') ?? 20)
            ->offset($request->get('offset') ?? 0)
            ->get();
        return new SuccessResponse($chats);
    }

}
