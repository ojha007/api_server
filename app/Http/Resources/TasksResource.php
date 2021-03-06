<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;


class TasksResource extends JsonResource
{

    public function toArray($request): array
    {

        $workers = $this->workers
            ->mapWithKeys(function ($worker) {
                return [
                    $worker->id => [
                        'id' => $worker->id,
                        'name' => $worker->name,
                        'email' => $worker->email,
                        'phone' => $worker->phone,

                    ]
                ];
            })->toArray();

        $payments = $this->booking->payment ?
            $this->booking->payment->sum('amount') . ' AUD' : 0;

        return [
            'id' => $this->id ?? '',
            'code' => $this->code ?? '',
            'title' => $this->title ?? '',
            'booking' => $this->booking ?? '',
            'workers' => $workers,
            'payment' => $payments

        ];
    }

}
