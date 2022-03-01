<?php

namespace App\Http\Requests;

use App\Models\TaskJourney;
use App\Requests\FormRequestForApi;

class TaskJourneyRequest extends FormRequestForApi
{
    public function rules(): array
    {
        return [
            'task_worker_id' => [
                'required',
                'exists:task_workers,id,worker_id,' . auth()->id(),
            ],
            'status' => 'required|in:' . implode(',', TaskJourney::getAllStatus()),
            'time' => 'required|date_format:H:i',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }

}
