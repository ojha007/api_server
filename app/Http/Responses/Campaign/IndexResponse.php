<?php


namespace App\Http\Responses\Campaign;


use Illuminate\Contracts\Support\Responsable;

class IndexResponse implements Responsable
{
    /**
     * @var string
     */
    private $viewPath;

    public function __construct(string $viewPath)
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
