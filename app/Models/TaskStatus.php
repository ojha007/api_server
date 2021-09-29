<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class TaskStatus extends Model
{

    const CODE = 'TS';
    protected $table = 'task_status';
    const PENDING='Pending';
    const STARTED='Started';
    const REJECTED='Rejected';
    const COMPLETED='Completed';

    protected $fillable = ['task_id', 'status', 'reason', 'user_id'];

    public function task(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Task::class);
    }
}
