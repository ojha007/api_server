<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Task extends Model
{

    const CODE = 'T';
    const PENDING = 'Pending';

    protected $table = 'tasks';

    protected $fillable = ['code', 'booking_id', 'title', 'description', 'images', 'task_completed'];

    public function workers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'task_workers', 'task_id', 'worker_id');
    }

    public function status(): BelongsTo
    {
        return $this->belongsTo(TaskStatus::class, 'task_id');
    }

    public function booking(): BelongsTo
    {
        return $this->belongsTo(Booking::class);
    }

    public function getAllWorkersAttribute(): string
    {
        if ($this->getRelation('workers')) {
            return $this->getRelation('workers')->pluck('name')->implode(',');
        }
        return '';
    }
}
