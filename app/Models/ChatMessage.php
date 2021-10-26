<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ChatMessage extends Model
{

    use SoftDeletes;

    protected $table = 'chat_messages';
    protected $fillable = ['chat_id', 'message', 'admin_id'];
}
