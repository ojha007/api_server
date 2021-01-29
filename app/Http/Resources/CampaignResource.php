<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;


class CampaignResource extends JsonResource
{

    public function toArray($request): array
    {
        return [
            'id' => $this->id ?? '',
            'title' => $this->date ?? '',

        ];
    }

}
