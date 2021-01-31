<?php


namespace App\Http\Responses\Booking;


use App\Http\Collection\BookingCollection;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class IndexResponse implements Responsable
{
    /**
     * @var string
     */
    private $viewPath;
    /**
     * @var Collection
     */
    private $collection;

    /**
     * IndexResponse constructor.
     * @param string $viewPath
     * @param LengthAwarePaginator $collection
     */
    public function __construct(string $viewPath, LengthAwarePaginator $collection)
    {

        $this->viewPath = $viewPath;
        $this->collection = $collection;
    }

    public function toResponse($request)
    {

        if ($request->wantsJson()) {
            return new BookingCollection($this->collection);
        }
        return view($this->viewPath . 'index')
            ->with('bookings', $this->collection);
    }
}
