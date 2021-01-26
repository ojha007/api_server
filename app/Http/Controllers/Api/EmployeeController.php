<?php


namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Http\Responses\SuccessResponse;
use App\Models\Employee;
use App\Repositories\EnquiryRepository;

class EmployeeController extends Controller
{


    /**
     * @var Employee
     */
    protected $model;
    /**
     * @var EnquiryRepository
     */
    protected $repository;

    public function __construct()
    {
        $this->model = new Employee();
        $this->repository = new EnquiryRepository($this->model);
    }

    public function index(): SuccessResponse
    {
        return new SuccessResponse([
            'test' => 'a'
        ]);
    }
}
