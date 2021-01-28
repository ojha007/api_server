<?php


namespace App\Http\Responses\Tasks;


use App\Http\Responses\SuccessResponse;
use Illuminate\Contracts\Support\Responsable;

class StoreResponse implements Responsable
{
    protected $routePath;

    /**
     * IndexResponse constructor.
     * @param $routePath
     */
    public function __construct($routePath)
    {
        $this->routePath = $routePath;

    }

    public function toResponse($request)
    {

        if ($request->wantsJson()) {
            return new SuccessResponse(null);
        }
        return redirect()
            ->route($this->routePath . 'index')
            ->with('success', 'Task created successfully .');
    }


}
