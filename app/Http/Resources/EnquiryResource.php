<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;


class EnquiryResource extends JsonResource
{

    public function toArray($request): array
    {
        return [
            'id' => $this->id ?? '',
            'user' => [
                'email' => $this->user->email ?? '',
                'name' => $this->user->name ?? '',
            ],
            'pickup_address' => [
                'country' => $this->pickUpAddress->state->country->name ?? ''
            ],
            'delivery_address' => [
                "country" => $this->deliveryAddress->state->country->name ?? ''

            ]
        ];
    }

    public function getData($enquiry_id): \Illuminate\Support\Collection
    {
        return DB::table('enquiries as e')
            ->select('title', 'id', 'description', 'date', 'c.name as country',
                's.name as state', 'street_one', 'street_two', 'city')
            ->join('enquiry_address as ea', 'ea.enquiry_id', '=', 'e.id')
            ->join('states as s', 'ea.state_id', '=', 's.id')
            ->join('country as c', 'c.id', '=', 's.country_id')
            ->where('e.id', '=', $enquiry_id)
            ->get();
    }
}
