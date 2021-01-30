<?php


namespace App\Http\Responses\Booking;


use Illuminate\Contracts\Support\Responsable;

class StoreResponse implements Responsable
{
    /**
     * @var string
     */
    private $routePath;

    /**
     * StoreResponse constructor.
     * @param string $routePath
     */
    public function __construct(string $routePath)
    {
        $this->routePath = $routePath;
    }

    public function toResponse($request)
    {
        if ($request->wantsJson()) {
            return response()->json([
                'data' => [
                    'message' => 'SUCCESS',
                    'code' => 201
                ]
            ]);
        }
        return redirect()->route($this->routePath . 'index')
            ->with('success', 'Booking added successfully');
    }
}
