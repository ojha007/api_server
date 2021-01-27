<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;


class EnquiryResource extends JsonResource
{

    public function toArray($request): array
    {
        return [
            'id' => $this->id ?? '',
            'date' => $this->date ?? '',
            'title' => $this->title ?? '',
            'description' => $this->description ?? '',
            'user' => [
                'email' => $this->user->email ?? '',
                'name' => $this->user->name ?? '',
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
