<?php


namespace App\Http\Responses\Worker;


use App\Http\Resources\WorkerResource;
use App\Models\User;
use App\Models\Worker;
use App\Repositories\WorkerRepository;
use Illuminate\Contracts\Support\Responsable;

class ShowResponse implements Responsable
{


    protected $viewPath;
    /**
     * @var WorkerRepository
     */
    protected $repository;
    /**
     * @var Worker
     */
    protected $model;
    /**
     * @var int
     */
    private $id;

    /**
     * ShowResponse constructor.
     * @param string $viewPath
     * @param int $id
     */
    public function __construct(string $viewPath, int $id)
    {
        $this->viewPath = $viewPath;
        $this->repository = new WorkerRepository(new User());
        $this->id = $id;
    }

    public function toResponse($request)
    {
        $worker = $this->repository->getById($this->id);
        if ($request->wantsJson()) {
            return new WorkerResource($worker);
        }
        return view($this->viewPath . 'show', compact('worker'));
    }
}
