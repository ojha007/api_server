<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;


class BookingResource extends JsonResource
{

    public function toArray($request): array
    {
        return [
            'id' => $this->id ?? '',
            'title' => $this->title ?? '',
            'user_id' => $this->user->id ?? '',
            'start_time' => $this->start_time ?? '',
            'end_time' => $this->end_time ?? '',
            'description' => $this->description ?? '',
            'address' => $this->address ?? '',
        ];
    }

}
