<?php


namespace App\Http\Controllers;


use App\Http\Requests\CampaignRequest;
use App\Http\Responses\Campaign\CreateResponse;
use App\Http\Responses\Campaign\IndexResponse;
use App\Http\Responses\Campaign\ShowResponse;
use App\Http\Responses\Campaign\StoreResponse;
use App\Http\Responses\ErrorResponse;
use App\Models\Campaign;
use App\Repositories\CampaignRepository;
use Illuminate\Support\Facades\DB;

class CampaignController extends Controller
{

    /**
     * @var string
     */
    protected $routerPath = 'campaigns.';

    /**
     * @var string
     */
    protected $viewPath = 'campaign.';
    /**
     * @var Campaign
     */
    protected $model;
    /**
     * @var CampaignRepository
     */
    protected $repository;

    public function __construct()
    {
        $this->middleware('auth');
        $this->model = new Campaign();
        $this->repository = new CampaignRepository($this->model);
    }

    public function index(): IndexResponse
    {
        return new IndexResponse($this->viewPath);
    }

    public function create(): CreateResponse
    {
        return new CreateResponse($this->viewPath);
    }

    public function store(CampaignRequest $request)
    {
        try {
            DB::beginTransaction();
            $attributes = $request->validated();
            $attributes['schedule'] = $request->get('schedule_time') ? now() : $request->get('schedule');
            $this->repository->create($attributes);
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            return new ErrorResponse($exception);
        }
        return new StoreResponse($this->routerPath);
    }

    public function show($id)
    {
        try {
            return new ShowResponse($this->viewPath, $id);
        } catch (\Exception $exception) {
            return new ErrorResponse($exception);
        }
    }

    public function edit($id)
    {
        $campaign = $this->repository->getById($id);
        return view($this->viewPath . 'edit', compact('campaign'));
    }

    public function update(CampaignRequest $request, $id)
    {
        try {
            DB::beginTransaction();
            $attributes = $request->validated();
            $attributes['schedule'] = $request->get('schedule_time') ? now() : $request->get('schedule');
            $this->repository->update($id, $attributes);
            DB::commit();
            return redirect()->route($this->routerPath . 'index')
                ->with('success', 'Campaign updated successfully');
        } catch (\Exception $exception) {
            DB::rollBack();
            return new ErrorResponse($exception);
        }
    }
}

