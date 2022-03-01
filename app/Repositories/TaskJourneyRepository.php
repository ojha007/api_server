<?php

namespace App\Repositories;

use App\Abstracts\Repository;
use App\Models\TaskJourney;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class TaskJourneyRepository extends Repository
{
    public function __construct(TaskJourney $model)
    {
        $this->model = $model;
    }


    public function storeJourney($attributes)
    {
        return $this->create($attributes);
    }

    public function findJourneyByTaskId($taskId): Collection
    {
        return DB::table('task_journey as tj')
            ->select('tj.time', 'tj.status', 'tj.id')
            ->join('task_workers as tw', 'tw.id', '=', 'tj.task_worker_id')
            ->where('tw.worker_id', auth()->id())
            ->where('tw.task_id', '=', $taskId)
            ->get();
    }
}
