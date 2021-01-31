<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Task extends Model
{

    const CODE = 'T';
    const PENDING = 'Pending';

    protected $table = 'tasks';

    protected $fillable = ['code', 'booking_id', 'title'];

    public function workers(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(User::class, 'task_worker', 'worker_id', 'task_id');
    }

    public function status(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(TaskStatus::class);
    }

    public function booking(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Booking::class);
    }
}
