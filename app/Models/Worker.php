<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Worker extends Model
{

    const CODE = 'W';
    protected $table = 'workers';
    protected $fillable = ['name', 'email', 'description', 'phone', 'code'];

    public function task(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Task::class, 'task_worker');
    }
}
