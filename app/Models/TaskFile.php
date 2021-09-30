<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class TaskFile extends Model
{


    protected $table = 'task_files';

    protected $fillable = ['task_id', 'type', 'url'];

    public function task(): HasOne
    {
        return $this->hasOne(Task::class);
    }
}
