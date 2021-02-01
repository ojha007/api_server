<?php


namespace App\Http\Responses\Tasks;


use App\Models\State;
use App\Models\User;
use App\Repositories\BaseRepository;
use App\Repositories\WorkerRepository;
use Illuminate\Contracts\Support\Responsable;

class CreateResponse implements Responsable
{
    protected $viewPath;

    /**
     * IndexResponse constructor.
     * @param $viewPath
     */
    public function __construct($viewPath)
    {
        $this->viewPath = $viewPath;
    }

    public function toResponse($request)
    {

        $selectStates = (new BaseRepository(new State()))->getSelectItems('name');
        $selectWorkers = (new WorkerRepository(new User()))->getSelectItems('name');
        return view($this->viewPath . 'create', compact('selectStates', 'selectWorkers'));
    }
}
