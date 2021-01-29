<?php


namespace App\Http\Collection;


use App\Http\Resources\CampaignResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class CampaignCollection extends ResourceCollection
{


    public function toArray($request)
    {
        return CampaignResource::collection($this->collection);
    }
}
