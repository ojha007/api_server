<?php


namespace App\Http\Collection;


use App\Http\Resources\WorkerResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Resources\Json\ResourceCollection;

class WorkerCollection extends ResourceCollection
{

    /**
     * @param Request $request
     * @return array|AnonymousResourceCollection
     */
    public function toArray($request)
    {
        return WorkerResource::collection($this->collection);
    }
}
