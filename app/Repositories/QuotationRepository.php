<?php


namespace App\Repositories;


use App\Abstracts\Repository;
use App\Models\Quotation;

class QuotationRepository extends Repository
{
    /**
     * @var Campaign
     */
    protected $model;

    public function __construct(Quotation $model)
    {
        $this->model = $model;
    }


}
