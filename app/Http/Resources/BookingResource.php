<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;


class BookingResource extends JsonResource
{

    public function toArray($request): array
    {
        return [
            'id' => $this->id ?? '',
            'email' => $this->email ?? '',
            'user_id' => $this->user->id ?? '',
            'name' => $this->name ?? '',
            'phone' => $this->phone ?? '',
            'moving_date' => $this->moving_date ?? '',
            'moving_from_suburb' => $this->moving_from_suburb ?? '',
            'moving_to_suburb' => $this->moving_to_suburb ?? '',
            'pickup_address' => $this->pickup_address ?? '',
            'dropoff_address' => $this->dropoff_address ?? '',
            'additional_address' => $this->additional_address ?? '',
            'access_parking' => $this->access_parking ?? '',
            'additional_service' => $this->additional_service ?? '',
            'size_of_moving' => $this->size_of_moving ?? '',
            'hear_about_us' => $this->hear_about_us ?? '',
            'inventory' => $this->inventory ?? '',
            'comments' => $this->comments ?? '',
        ];
    }

}
