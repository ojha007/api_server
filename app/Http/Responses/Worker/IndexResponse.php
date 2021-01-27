<?php


namespace App\Http\Responses\Worker;


use Illuminate\Contracts\Support\Responsable;

class IndexResponse implements Responsable
{

    private $viewPath;

    public function __construct($viewPath)
    {
        $this->viewPath = $viewPath;
    }

    public function toResponse($request)
    {
        if ($request->wantsJson()) {
        }
        return view($this->viewPath . 'index');
    }
}
