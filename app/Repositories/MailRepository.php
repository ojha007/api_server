<?php


namespace App\Repositories;


use App\Abstracts\Repository;
use App\Models\Mail;

class MailRepository extends Repository
{
    /**
     * @var Mail
     */
    protected $model;

    public function __construct(Mail $model)
    {
        $this->model = $model;
    }

}
