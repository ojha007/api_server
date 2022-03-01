<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TaskJourneyRequest;
use App\Http\Responses\ErrorResponse;
use App\Http\Responses\SuccessResponse;
use App\Models\TaskJourney;
use App\Repositories\TaskJourneyRepository;

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


}
