<?php


namespace App\Http\Responses\Enquiry;


use App\Http\Collection\EnquiryCollection;
use App\Models\Enquiry;
use App\Repositories\EnquiryRepository;
use Illuminate\Contracts\Support\Responsable;

class IndexResponse implements Responsable
{

    /**
     * @var Enquiry
     */
    protected $model;
    /**
     * @var EnquiryRepository
     */
    private $repository;
    private $viewPath;

    /**
     * IndexResponse constructor.
     * @param string $viewPath
     */
    public function __construct(string $viewPath)
    {
        $this->model = new Enquiry();
        $this->viewPath = $viewPath;
        $this->repository = new EnquiryRepository($this->model);
    }

    public function toResponse($request)
    {

        $enquiries = $this->repository->getAllByUser();
        if ($request->wantsJson()) {
            return new EnquiryCollection($enquiries);
        } else {
            return view($this->viewPath . 'index', compact('enquiries'));
        }
    }

}
