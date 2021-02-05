<?php


namespace App\Http\Controllers;


use App\Http\Requests\WorkerRequest;
use App\Http\Responses\ErrorResponse;
use App\Http\Responses\Worker\IndexResponse;
use App\Http\Responses\Worker\ShowResponse;
use App\Http\Responses\Worker\StoreResponse;
use App\Http\Responses\Worker\UpdateResponse;
use App\Models\User;
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
        $this->middleware('permission:worker-view', ['only' => 'index', 'show']);
        $this->middleware('permission:worker-edit', ['expect' => 'destroy']);
        $this->repository = new WorkerRepository(new User());
    }

    public function index(): IndexResponse
    {
        try {
            $workers = $this->repository->getAllWorkers();
            return new IndexResponse($this->viewPath, $workers);
        } catch (\Exception $exception) {

        }

    }

    public function create()
    {
        return view($this->viewPath . 'create');
    }

    public function edit($id)
    {
        try {
            $worker = $this->repository->getById($id);
            return view($this->viewPath . 'edit', compact('worker'));
        } catch (\Exception $exception) {
            return new ErrorResponse($exception);
        }
    }

    public function store(WorkerRequest $request)
    {
        try {
            DB::beginTransaction();
            $attributes = $request->all();
            $attributes['password'] = bcrypt($attributes['password']);
            $attributes['super'] = false;
            $worker = $this->repository->create($attributes);
            $worker->assignRole(User::WORKER);
            DB::commit();
            return new StoreResponse($this->routePath);
        } catch (\Exception $exception) {
            DB::rollBack();
//            dd($exception);
            return new ErrorResponse($exception);
        }

    }

    public function update(WorkerRequest $request, $id)
    {
        try {
            DB::beginTransaction();
            $attributes = $request->validated();
            $attributes['password'] = bcrypt($attributes['password']);
            $attributes['super'] = false;
            $worker = $this->repository->update($id, $attributes);
            $worker->assignRole(User::WORKER);
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            return new ErrorResponse($exception);
        }
        return new UpdateResponse($this->routePath);
    }

    public function destroy()
    {
    }
    public function show($id): ShowResponse
    {

        return new  ShowResponse($this->viewPath,$id);
    }

}
