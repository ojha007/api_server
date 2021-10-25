<?php

namespace App\Http\Controllers;

use App\Http\Responses\SuccessResponse;
use App\Models\Message;
use Illuminate\Http\Request;

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
}
