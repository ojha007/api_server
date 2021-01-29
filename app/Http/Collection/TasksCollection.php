<?php


namespace App\Http\Collection;


use App\Http\Resources\TasksResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class TasksCollection extends ResourceCollection
{


    public function toArray($request)
    {
        return TasksResource::collection($this->collection);
    }
}
