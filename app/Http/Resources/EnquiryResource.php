<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;


class EnquiryResource extends JsonResource
{

    public function toArray($request): array
    {
//        'mobile_number', 'email', 'address1', 'address2',
//        'city', 'state', 'postal_code', 'pickup_date',
//        'delivery_date', 'optional_number', 'age', 'comment', 'user_id'
        return [
            'id' => $this->id ?? '',
            'email' => $this->email ?? '',
            'first_name' => $this->first_name ?? '',
            'last_name' => $this->last_name ?? '',
            'mobile_number' => $this->mobile_number ?? '',
            'address1' => $this->address1 ?? '',
            'address2' => $this->address2 ?? '',
            'city' => $this->city ?? '',
            'postal_code' => $this->postal_code ?? '',
            'pickup_date' => $this->pickup_date ?? '',
            'delivery_date' => $this->delivery_date ?? '',
            'optional_number' => $this->optional_number ?? '',
            'age' => $this->age ?? '',
            'comment' => $this->comment ?? '',
            'user_id' => $this->user_id ?? '',
        ];
    }

}
