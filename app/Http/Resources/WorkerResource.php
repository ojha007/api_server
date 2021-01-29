<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;


class WorkerResource extends JsonResource
{

    public function toArray($request): array
    {

        return [
            'id' => $this->id ?? '',
            'phone' => $this->phone ?? '',
            'status' => $this->status ?? '',
            'avatar' => $this->avatar ?? '',
            'name' => $this->name ?? '',
            'email' => $this->email ?? ''
        ];
    }

}
