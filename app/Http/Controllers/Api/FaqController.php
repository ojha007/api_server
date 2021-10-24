<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Responses\SuccessResponse;
use App\Models\FAQ;
use App\Repositories\FaqRepository;

class FaqController extends Controller
{

    /**
     * @var FaqRepository
     */
    protected $repository;

    public function __construct()
    {
        $this->repository = new FaqRepository(new FAQ());
    }

    public function index(): SuccessResponse
    {
        $faqs = $this->repository->getAllActive();
        return new SuccessResponse($faqs);
    }


}
