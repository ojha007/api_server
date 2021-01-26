<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Enquiry extends Model
{
    const PICKUP = 'PICKUP';
    const DELIVERY = 'DELIVERY';
    protected $fillable = ['title', 'description', 'date', 'user_id'];

    protected $with = ['pickUpAddress', 'deliveryAddress', 'user'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function pickUpAddress(): BelongsTo
    {
        return $this->belongsTo(EnquiryAddress::class, 'id', 'enquiry_id')
            ->where('type', self::PICKUP);
    }

    public function deliveryAddress(): BelongsTo
    {
        return $this->belongsTo(EnquiryAddress::class, 'id', 'enquiry_id')
            ->where('type', self::DELIVERY);
    }



}

