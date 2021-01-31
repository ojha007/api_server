<?php


namespace App\Repositories;


use App\Abstracts\Repository;
use App\Models\Booking;
use App\Models\Campaign;
use Illuminate\Support\Facades\Auth;

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

    public function getAllByUser(): \Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
        $auth = Auth::user();
        return Booking::with('user')
            ->when($auth->super == 0, function ($query) {
                $query->where('user_id', \auth()->id());
            })->paginate(15);
    }

}
