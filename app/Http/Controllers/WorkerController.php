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
use App\Repositories\XeroRepository;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

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
     * @var XeroRepository
     */
    protected $repository;

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:worker-view', ['only' => 'index', 'show']);
        $this->middleware('permission:worker-edit', ['expect' => 'destroy']);
        $this->repository = new XeroRepository(new User());
    }

    public function index()
    {
        try {
            $workers = $this->repository->getAllWorkers();
            return new IndexResponse($this->viewPath, $workers);
        } catch (Exception $exception) {
            return;
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
        } catch (Exception $exception) {
            return new ErrorResponse($exception);
        }
    }

    public function store(WorkerRequest $request)
    {
        try {
            DB::beginTransaction();
            $attributes = $request->all();
            $password = Str::random(10);
            $attributes['password'] = bcrypt($password);
            $worker = $this->repository->create($attributes);
            $worker->assignRole(User::WORKER);
            DB::commit();
            return new StoreResponse($worker, $password, $this->routePath);
        } catch (Exception $exception) {
            DB::rollBack();
            return new ErrorResponse($exception);
        }

    }

    public function update(WorkerRequest $request, $id)
    {
        try {
            DB::beginTransaction();
            $attributes = $request->validated();
            $password = Str::random(10);
            $attributes['password'] = bcrypt($password);
            $attributes['super'] = false;
            $worker = $this->repository->update($id, $attributes);
            $worker->assignRole(User::WORKER);
            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();
            return new ErrorResponse($exception);
        }
        return new UpdateResponse($this->routePath);
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            $this->repository->delete($id);
            DB::commit();
            return redirect()->back()->with('success', 'Worker deleted successfully');
        } catch (Exception $exception) {
            DB::rollBack();
            return new ErrorResponse($exception);
        }
    }

    public function show($id): ShowResponse
    {
        return new  ShowResponse($this->viewPath, $id);
    }

}
