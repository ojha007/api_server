<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TaskJourneyRequest;
use App\Http\Responses\ErrorResponse;
use App\Http\Responses\SuccessResponse;
use App\Models\TaskJourney;
use App\Repositories\TaskJourneyRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TaskJourneyController extends Controller
{
    /**
     * @var TaskJourneyRepository
     */
    protected $repository;

    public function __construct()
    {
        $this->middleware('auth:api');
        $this->repository = new TaskJourneyRepository(new TaskJourney());

    }

    public function store(TaskJourneyRequest $request)
    {
        $attributes = $request->validated();
        try {
            $this->repository->create($attributes);
            return new SuccessResponse([]);
        } catch (\Exception $exception) {
            return new ErrorResponse($exception);
        }
    }

    public function show($taskId)
    {
        try {
            $data = $this->repository->findJourneyByTaskId($taskId);
            return new SuccessResponse($data);
        } catch (\Exception $exception) {
            return new ErrorResponse($exception);
        }

    }


    public function taskTime($workerId): SuccessResponse
    {

        $data = DB::select(DB::raw("
            with timeDiff as (
                select t.time, row_number() over (partition by t.status) as ran
                from task_journey as t
                where t.task_worker_id = ?
                  and status in ('PAUSED', 'RESTART')
            ),break as (
                     select max(time) - min(time) as breakTime
                     from timeDiff
                     group by ran
            ),workingTime as (
                     select startTime.time                                as startTime,
                            endTime.time                                  as endTime,
                            CAST((endTime.time - startTime.time) as time) as totalTime,
                            cast(break.breakTime as time)                 as breakTime
                     from task_journey t
                              join task_journey startTime
                                   on t.task_worker_id = startTime.task_worker_id and startTime.status = 'START'
                              join task_journey endTime on t.task_worker_id = endTime.task_worker_id and endTime.status = 'END'
                              join break on true
                     where t.task_worker_id = ?
                       and t.status in ('START', 'END')
                     limit 1) select *, TIMEDIFF(totalTime, breakTime) as workedTime from workingTime;
        "),[$workerId,$workerId]);
        return new SuccessResponse($data);


    }


}
