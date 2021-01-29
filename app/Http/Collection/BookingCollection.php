<?php


namespace App\Http\Collection;


use Illuminate\Http\Resources\Json\ResourceCollection;

class BookingCollection extends ResourceCollection
{

    public function toArray($request)
    {
        return BookingCollection::collection($this->collection);
    }
}
