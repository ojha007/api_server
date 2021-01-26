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
     * @return array|AnonymousResourceCollection
     */
    public function toArray($request)
    {
        return EnquiryResource::collection($this->collection);
    }
}
