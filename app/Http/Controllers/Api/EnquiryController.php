<?php


namespace App\Http\Controllers\Api;


use App\Models\Enquiry;
use App\Repositories\EnquiryRepository;

class EnquiryController extends \App\Http\Controllers\EnquiryController
{

    protected $repository;

    public function __construct()
    {
//        $this->middleware('auth:api');
        $this->repository = new EnquiryRepository(new Enquiry());
    }
}
