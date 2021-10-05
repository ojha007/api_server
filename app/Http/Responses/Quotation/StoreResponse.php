<?php


namespace App\Http\Responses\Quotation;


use Illuminate\Contracts\Support\Responsable;

class StoreResponse implements Responsable
{

    /**
     * @var string
     */
    private $routePath;
    /**
     * @var string
     */
    protected $event;

    /**
     * StoreResponse constructor.
     * @param string $routePath
     * @param string $event
     */
    public function __construct(string $routePath, string $event = 'created')
    {
        $this->routePath = $routePath;
        $this->event = $event;
    }

    public function toResponse($request)
    {

        return redirect()
            ->route($this->routePath . 'index')
            ->with('success', 'Quotation ' . $this->event . ' successfully');
    }
}
