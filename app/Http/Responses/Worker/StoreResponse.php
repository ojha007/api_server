<?php


namespace App\Http\Responses\Worker;


use Illuminate\Contracts\Support\Responsable;

class StoreResponse implements Responsable
{


    /**
     * @var
     */
    private $routePath;

    /**
     * StoreResponse constructor.
     * @param $routePath
     */
    public function __construct($routePath)
    {
        $this->routePath = $routePath;
    }

    public function toResponse($request)
    {
        if ($request->wantsJson()) {
        }
        return redirect()
            ->route($this->routePath . 'index')
            ->with('success', 'Worker Created successfully');
    }
}
