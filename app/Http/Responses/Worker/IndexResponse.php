<?php


namespace App\Http\Responses\Worker;


use App\Http\Collection\WorkerCollection;
use App\Models\User;
use App\Models\Worker;
use App\Repositories\XeroRepository;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Support\Collection;

class IndexResponse implements Responsable
{

    private $viewPath;
    /**
     * @var XeroRepository
     */
    protected $repository;
    /**
     * @var Worker
     */
    protected $model;
    /**
     * @var Collection
     */
    private $collection;

    /**
     * IndexResponse constructor.
     * @param $viewPath
     * @param Collection $collection
     */
    public function __construct($viewPath, Collection $collection)
    {
        $this->viewPath = $viewPath;
        $this->repository = new XeroRepository(new User());
        $this->collection = $collection;
    }


    public function toResponse($request)
    {
        $workers = $this->collection;
        if ($request->wantsJson()) {
            return new WorkerCollection($workers);
        }
        return view($this->viewPath . 'index', compact('workers'));
    }
}
