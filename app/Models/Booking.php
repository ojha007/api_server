<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{

    protected $fillable = ['from_email', 'subject', 'message', 'schedule'];

}
