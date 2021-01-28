<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Task extends Model
{

    const CODE = 'T';
    const PENDING = 'Pending';
    protected $table = 'tasks';

    protected $fillable = ['title', 'date', 'description', 'state_id', 'address', 'code'];

    public function workers(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Worker::class, 'task_worker');
    }

    public function status(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(TaskStatus::class);
    }
}
