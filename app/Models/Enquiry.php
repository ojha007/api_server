<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Enquiry extends Model
{

    protected $fillable = ['title', 'description', 'date', 'user_id'];


    protected $hidden = ['created_at', 'deleted_at', 'updated_at'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

//    public function pickUpAddress(): BelongsTo
//    {
//        return $this->belongsTo(PickupAddress::class, 'id', 'enquiry_id');
//    }
//
//    public function deliveryAddress(): BelongsTo
//    {
//        return $this->belongsTo(DeliveryAddress::class, 'id', 'enquiry_id');
//    }

//    public function getPickupDetailAttribute(): string
//    {
//        $pickup_address = '';
//        if ($this->pickUpAddress()->exists()) {
//            $p = $this->getRelation('pickUpAddress')->first();
//            $pickup_address = $this->generateAddress($p);
//        }
//        return $pickup_address;
//    }
//
//    public function getDeliveryDetailAttribute(): string
//    {
//        $delivery_address = '';
//        if ($this->deliveryAddress()->exists()) {
//            $p = $this->getRelation('deliveryAddress')->first();
//            $delivery_address = $this->generateAddress($p);
//        }
//        return $delivery_address;
//    }

//    public function generateAddress($address): string
//    {
//        $baseString = null;
//        $s = $address->state;
//        $baseString = $address->street_one . ($address->street_two ? ',' . $address->street_two : "")
//            . ',' . $address->city . ' ' . $address->postal_code;
//        if ($s) {
//            $baseString .= ',' . $s->name;
//            $c = $s->country;
//            if ($c) {
//                $baseString .= ',' . $c->name;
//            }
//        }
//        return $baseString;
//    }
}

