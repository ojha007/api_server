<?php


namespace App\Http\Controllers;


use App\Http\Requests\TaskRequest;
use App\Http\Responses\ErrorResponse;
use App\Http\Responses\Tasks\CreateResponse;
use App\Http\Responses\Tasks\IndexResponse;
use App\Http\Responses\Tasks\ShowResponse;
use App\Http\Responses\Tasks\StoreResponse;
use App\Models\Task;
use App\Repositories\TaskRepository;
use Illuminate\Support\Facades\DB;

class TaskController extends Controller
{

    /**
     * @var string
     */
    protected $viewPath = 'tasks.';
    /**
     * @var string
     */
    protected $routePath = 'tasks.';
    /**
     * @var Task
     */
    protected $model;

    protected $repository;

    public function __construct()
    {
        $this->middleware('auth');
        $this->repository = new TaskRepository(new Task());
    }

    public function index(): IndexResponse
    {
        return new IndexResponse($this->viewPath);
    }

    public function create(): CreateResponse
    {
        return new CreateResponse($this->viewPath);
    }

    public function update()
    {
    }

    public function edit()
    {
    }

    public function destroy(): ErrorResponse
    {
        try {
            DB::beginTransaction();
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            return new ErrorResponse($exception);
        }
    }

    public function store(TaskRequest $request)
    {
        try {
            DB::beginTransaction();
            $attributes['tasks'] = $request->except('user_id');
            $maxId = $this->repository->maxId();
            $attributes['tasks']['code'] = Task::CODE . str_pad(($maxId + 1), 4, '0', STR_PAD_LEFT);
            $task = $this->repository->create($attributes['tasks']);
            if ($request->get('user_id')) {
                $task->workers()->sync([
                    'user_id' => $request->get('user_id'),
                ]);
            }
            $task->status()->create([
                'status' => Task::PENDING,
                'user_id' => auth()->id()
            ]);
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            return new ErrorResponse($exception);
        }
        return new StoreResponse($this->routePath);
    }

    public function show($id)
    {
        try {
            $task = $this->repository->getByIdWith($id, 'workers', 'status', 'booking');
            return new ShowResponse($this->viewPath, $task);
        } catch (\Exception $exception) {
            return new ErrorResponse($exception);
        }
    }

    public function calendar(): \Illuminate\Http\JsonResponse
    {
        return response()->json(
            $this->repository->getTaskForCalendar()
        );

    }
}
