<?php


namespace App\Http\Controllers;


use App\Http\Requests\WorkerRequest;
use App\Http\Responses\ErrorResponse;
use App\Http\Responses\Worker\IndexResponse;
use App\Http\Responses\Worker\StoreResponse;
use App\Models\Worker;
use App\Repositories\WorkerRepository;
use Illuminate\Support\Facades\DB;

class WorkerController extends Controller
{

    /**
     * @var string
     */
    protected $routePath = 'workers.';
    /**
     * @var string
     */
    protected $viewPath = 'workers.';
    /**
     * @var Worker
     */
    protected $model;
    /**
     * @var WorkerRepository
     */
    protected $repository;

    public function __construct()
    {
        $this->middleware('auth');
        $this->model = new Worker();
        $this->repository = new WorkerRepository($this->model);
    }

    public function index(): IndexResponse
    {
        return new IndexResponse($this->viewPath);
    }

    public function create()
    {
        return view('workers.partials.create');
    }

    public function edit()
    {
    }

    public function store(WorkerRequest $request)
    {
        try {
            DB::beginTransaction();
            $attributes = $request->validated();
            $maxId = $this->repository->maxId();
            $attributes['code'] = Worker::CODE .str_pad(($maxId + 1), 4, '0', STR_PAD_LEFT);
            $this->repository->create($attributes);
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            return new ErrorResponse($exception);
        }
        return new StoreResponse($this->routePath);
    }

    public function update()
    {
    }

    public function destroy()
    {
    }

}
