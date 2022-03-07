<?php


namespace App\Http\Responses\Tasks;


use App\Models\User;
use App\Repositories\XeroRepository;
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

        $selectStates = [];
        $selectWorkers = (new XeroRepository(new User()))->getSelectItems('name');
        return view($this->viewPath . 'create', compact('selectStates',
            'selectWorkers'));
    }
}
