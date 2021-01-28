<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;


class WorkerResource extends JsonResource
{

    public function toArray($request): array
    {
        return [
            'id' => $this->id ?? '',
            'code' => $this->code ?? '',
            'name' => $this->name ?? '',
            'email' => $this->email ?? ''
        ];
    }

}
