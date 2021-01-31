<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Booking extends Model
{
    protected $hidden = ['created_at', 'updated_at'];

    protected $fillable = [
        'is_verified',
        'user_id',
        'name',
        'email',
        'phone',
        'moving_date',
        'moving_from_suburb',
        'moving_to_suburb',
        'pickup_address',
        'dropoff_address',
        'additional_address',
        'access_parking',
        'additional_service',
        'size_of_moving',
        'hear_about_us',
        'inventory',
        'comments',
        'quotes'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function payment(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(BookingPayment::class, 'booking_id');
    }

    public function task(): BelongsTo
    {
        return $this->belongsTo(Task::class, 'booking_id');
    }
}
