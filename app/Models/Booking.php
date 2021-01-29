<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Booking extends Model
{

    protected $fillable = ['user_id', 'start_time', 'end_time', 'title', 'description', 'address'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
