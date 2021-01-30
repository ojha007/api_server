<?php


namespace App\Http\Responses\Enquiry;


use Illuminate\Contracts\Support\Responsable;

class StoreResponse implements Responsable
{


    /**
     * @var string
     */
    protected $baseRoute;

    /**
     * IndexResponse constructor.
     * @param string $baseRoute
     */
    public function __construct(string $baseRoute)
    {
        $this->baseRoute = $baseRoute;
    }

    public function toResponse($request)
    {
        if ($request->wantsJson()) {
            return response()->json([
                'data' => [
                    'status' => 201,
                    'message' => 'SUCCESS'
                ]]);
        } else {
            return redirect()->route($this->baseRoute . '.index')
                ->with('success', 'Enquiry Added Successfully');
        }


    }
}
