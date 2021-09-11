<?php


namespace App\Http\Collection;


use App\Http\Resources\EnquiryResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Resources\Json\ResourceCollection;

class EnquiryCollection extends ResourceCollection
{

    /**
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function toArray($request): AnonymousResourceCollection
    {
        return EnquiryResource::collection($this->collection);
    }
}
