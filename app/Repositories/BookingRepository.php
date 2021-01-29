<?php


namespace App\Repositories;


use App\Abstracts\Repository;
use App\Models\Booking;
use App\Models\Campaign;

class BookingRepository extends Repository
{
    /**
     * @var Campaign
     */
    protected $model;

    public function __construct(Booking $model)
    {
        $this->model = $model;
    }


}
