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

    public static function allSizeOfMoving(): array
    {
        return [
            'internal_move' => 'Internal move',
            '1_3_items' => '1-3 Items',
            '4_9_items' => '4-9 Items',
            '10_15_items' => '10-15 Items',
            '1_bedroom_studio_apartment' => '1 Bedroom/Studio apartment',
            '2_bedroom_apartment_house' => '2 Bedroom apartment / House',
            '3_bedroom_apartment_house' => '3 Bedroom apartment / House',
            '4_bedroom_house' => '4+ Bedroom House',
            'interstate' => 'Interstate (East Coast)',
            'country' => 'Country',
            'office' => 'Office / Business'
        ];
    }

    public function getSizeofMoving($id): string
    {
        return $this::allSizeOfMoving()[$id];
    }
}
