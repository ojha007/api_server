<?php


namespace App\Http\Responses\Campaign;


use App\Http\Collection\CampaignCollection;
use App\Models\Campaign;
use App\Repositories\CampaignRepository;
use Illuminate\Contracts\Support\Responsable;

class IndexResponse implements Responsable
{
    /**
     * @var string
     */
    private $viewPath;
    /**
     * @var Campaign
     */
    protected $model;
    /**
     * @var CampaignRepository
     */
    protected $repository;

    public function __construct(string $viewPath)
    {

        $this->viewPath = $viewPath;
        $this->model = new Campaign();
        $this->repository = new CampaignRepository($this->model);
    }

    public function toResponse($request)
    {

        $campaigns = $this->repository->getAll();
        if ($request->wantsJson()) {
            return  new CampaignCollection($campaigns);
        }
        return view($this->viewPath . 'index', compact('campaigns'));
    }
}
