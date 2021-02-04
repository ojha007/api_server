<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Mail extends Model
{
    protected $fillable = ['to', 'subject', 'message', 'draft'];


}
