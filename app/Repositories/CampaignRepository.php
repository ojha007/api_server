<?php


namespace App\Repositories;


use App\Abstracts\Repository;
use App\Models\Campaign;

class CampaignRepository extends Repository
{
    /**
     * @var Campaign
     */
    protected $model;

    public function __construct(Campaign $model)
    {
        $this->model = $model;
    }


}
