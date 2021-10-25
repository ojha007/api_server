<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChatRequest;
use App\Http\Responses\ErrorResponse;
use App\Http\Responses\SuccessResponse;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChatController extends Controller
{

    public function chat(ChatRequest $request)
    {
        try {
            $attributes = $request->validated();
            $attributes['customer_id'] = auth()->id() ?? null;
            Message::create($attributes);
            return new SuccessResponse();
        } catch (\Exception $exception) {
            return new ErrorResponse($exception);
        }
    }


    public function getAllChats(Request $request): SuccessResponse
    {
        $chats = DB::table('messages')
            ->select('message', 'id')
            ->whereNull('deleted_at')
            ->where('identifier', $request->get('identifier'))
            ->orWhere('customer_id', auth()->id())
            ->orderBy('created_at')
            ->limit($request->get('limit') ?? 20)
            ->offset($request->get('offset') ?? 0)
            ->get();
        return new SuccessResponse($chats);
    }
}
