<?php


namespace App\Repositories;


use Illuminate\Database\Eloquent\Model;

class BaseRepository
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function getSelectItems($text)
    {
        return $this->model->all()->mapWithKeys(function ($item) use ($text) {
            return [$item->id => $item->$text];
        });
    }
}
