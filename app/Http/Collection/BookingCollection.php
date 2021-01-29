<?php


namespace App\Http\Collection;


use App\Http\Resources\BookingResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class BookingCollection extends ResourceCollection
{

    public function toArray($request)
    {
        return BookingResource::collection($this->collection);
    }
}
