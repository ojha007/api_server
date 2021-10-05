<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Task extends Model
{

    const CODE = 'T';
    const PENDING = 'Pending';

    protected $table = 'tasks';
    protected $appends = ['CurrentStatus'];
    protected $with = ['workers', 'statuses', 'images'];

    protected $fillable = ['code', 'booking_id', 'title', 'description',];

    public function workers(): BelongsToMany
    {
        return $this->belongsToMany(User::class,
            'task_workers', 'task_id', 'worker_id');
    }

    public function statuses(): HasMany
    {
        return $this->hasMany(TaskStatus::class, 'task_id');
    }

    public function images(): HasMany
    {
        return $this->hasMany(TaskFile::class, 'task_id');
    }

    public function getCurrentStatusAttribute()
    {
        $sts = $this->status();
        return $sts->status ?? 'Pending';
    }

    public function status()
    {
        return $this->statuses()->orderByDesc('created_at')->first();
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
