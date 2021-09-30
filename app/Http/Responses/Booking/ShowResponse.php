<?php


namespace App\Http\Responses\Booking;


use App\Http\Resources\BookingResource;
use App\Models\Booking;
use Illuminate\Contracts\Support\Responsable;

class ShowResponse implements Responsable
{

    /**
     * @var string
     */
    protected $viewPath;
    /**
     * @var Booking
     */
    protected $booking;


    /**
     * ShowResponse constructor.
     * @param string $viewPath
     * @param Booking $booking
     */
    public function __construct(string $viewPath, Booking $booking)
    {

        $this->viewPath = $viewPath;
        $this->booking = $booking;
    }

    public function toResponse($request)
    {
        if ($request->wantsJson()) {
            $a = new BookingResource($this->booking);
            return  ['status'=>201,'message'=>'SUCCESS','data'=>$a];
        }
        return view($this->viewPath . 'show')
            ->with('booking', $this->booking);
    }
}
