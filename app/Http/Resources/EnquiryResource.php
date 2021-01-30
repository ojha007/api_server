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
            'mobile_number' => $this->mobile_number ?? '',
            'user' => [
                'email' => $this->user->email ?? '',
                'first_name' => $this->first_name ?? '',
                'last_name' => $this->last_name ?? ''
            ],
            'pickup_address' => [
                'country' => $this->pickUpAddress->state->country->name ?? '',
                'state' => $this->pickUpAddress->state->name ?? '',
                'postal_code' => $this->pickUpAddress->postal_code ?? '',
                'street_one' => $this->pickUpAddress->street_one ?? '',
                'street_two' => $this->pickUpAddress->street_two ?? '',
                'city' => $this->pickUpAddress->city ?? '',
            ],
            'delivery_address' => [
                "country" => $this->deliveryAddress->state->country->name ?? '',
                "state" => $this->deliveryAddress->state->name ?? '',
                'postal_code' => $this->deliveryAddress->postal_code ?? '',
                'street_one' => $this->deliveryAddress->street_one ?? '',
                'street_two' => $this->deliveryAddress->street_two ?? '',
                'city' => $this->deliveryAddress->city ?? '',
            ]
        ];
    }

}
