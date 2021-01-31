<?php


namespace App\Repositories;


use App\Abstracts\Repository;
use App\Models\Employee;
use App\Models\Enquiry;
use Illuminate\Support\Facades\Auth;

class EnquiryRepository extends Repository
{

    /**
     * @var Employee
     */
    protected $model;

    /**
     * EmployeeRepository constructor.
     * @param Enquiry $model
     */
    public function __construct(Enquiry $model)
    {
        $this->model = $model;
    }

    public function getAllByUser(): \Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
        $auth = Auth::user();
        return Enquiry::with('user')
            ->when($auth->super == 0, function ($query) {
                $query->where('user_id', \auth()->id());
            })->paginate(15);
    }

}
