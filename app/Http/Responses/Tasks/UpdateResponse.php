<?php


namespace App\Http\Responses\Tasks;


use Illuminate\Contracts\Support\Responsable;

class UpdateResponse implements Responsable
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
            return response()
                ->json(
                    [
                        'status' => 201,
                        'message' => 'SUCCESS'
                    ]
                );
        }
        return redirect()
            ->route($this->routePath . 'index')
            ->with('success', 'Task updated successfully .');
    }


}
