<?php


namespace App\Http\Controllers\Api;


use App\Models\Booking;
use App\Repositories\BookingRepository;

class BookingController extends \App\Http\Controllers\BookingController
{

    /**
     * @var
     */
    protected $repository;

    public function __construct()
    {
//        $this->middleware('auth:api');
        $this->repository = new BookingRepository(new Booking());
    }
}
