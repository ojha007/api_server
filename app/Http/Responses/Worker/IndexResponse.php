<?php


namespace App\Http\Responses\Worker;


use App\Http\Collection\WorkerCollection;
use App\Models\Worker;
use App\Repositories\WorkerRepository;
use Illuminate\Contracts\Support\Responsable;

class IndexResponse implements Responsable
{

    private $viewPath;
    /**
     * @var WorkerRepository
     */
    protected $repository;
    /**
     * @var Worker
     */
    protected $model;

    public function __construct($viewPath)
    {
        $this->viewPath = $viewPath;
        $this->model = new Worker();
        $this->repository = new WorkerRepository($this->model);
    }


    public function toResponse($request)
    {
        $workers = $this->repository->getWith('task');
        if ($request->wantsJson()) {
            return new WorkerCollection($workers);
        }
        return view($this->viewPath . 'index', compact('workers'));
    }
}
