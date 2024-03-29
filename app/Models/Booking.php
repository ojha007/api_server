<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

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
        'additional_address',
        'description',
        'additional_service',
        'size_of_moving',
        'hear_about_us',
        'latitude',
        'longitude',
        'inventory',
        'comments',
        'quotes',
        'time',
        "pickup_latitude",
        "pickup_longitude",
        "dropoff_latitude",
        "dropoff_longitude",
    ];



    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function payment(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(BookingPayment::class, 'booking_id');
    }

    public function task(): HasOne
    {
        return $this->hasOne(Task::class, 'booking_id');
    }

    public static function allSizeOfMoving(): array
    {
        $array = [];
        foreach ([
                     'Internal move',
                     '1-3 Items',
                     '4-9 Items',
                     '10-15 Items',
                     '1 Bedroom/Studio apartment',
                     '2 Bedroom apartment / House',
                     '3 Bedroom apartment / House',
                     '4+ Bedroom House',
                     'Interstate (East Coast)',
                     'Country',
                     'Office / Business'
                 ] as $item) {
            $array[$item] = $item;
        };
        return $array;
    }

    public static function allAdditionalServices(): array
    {
        return [
            'Packing',
            'Unpacking',
            'Packing & Unpacking',
            'Storage',
            'Work Installation',
            'Rubbish Removal',
        ];
    }


}
