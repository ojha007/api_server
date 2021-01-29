<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;


class CampaignResource extends JsonResource
{

    public function toArray($request): array
    {
        return [
            'id' => $this->id ?? '',
            'from_email' => $this->from_email ?? '',
            'subject' => $this->subject ?? '',
            'schedule' => $this->schedule ?? '',

        ];
    }

}
