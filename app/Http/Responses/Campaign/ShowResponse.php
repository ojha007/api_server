<?php


namespace App\Http\Responses\Campaign;


use App\Http\Resources\CampaignResource;
use App\Models\Campaign;
use App\Repositories\CampaignRepository;
use Illuminate\Contracts\Support\Responsable;

class ShowResponse implements Responsable
{
    /**
     * @var Campaign
     */
    protected $model;
    /**
     * @var CampaignRepository
     */
    protected $repository;
    /**
     * @var string
     */
    private $viewPath;
    /**
     * @var int
     */
    private $id;

    /**
     * ShowResponse constructor.
     * @param string $viewPath
     * @param int $id
     */
    public function __construct(string $viewPath, int $id)
    {

        $this->viewPath = $viewPath;
        $this->model = new Campaign();
        $this->repository = new CampaignRepository($this->model);
        $this->id = $id;
    }

    public function toResponse($request)
    {

        $campaign = $this->repository->getById($this->id);
        if ($request->wantsJson()) {
            return new CampaignResource($campaign);
        }
        return view($this->viewPath . 'show', compact('campaign'));
    }
}
