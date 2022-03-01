<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class TaskJourney extends Model
{
    protected $table = 'task_journey';
    const START = 'START';
    const RESTART = 'RESTART';
    const END = 'END';
    const PAUSED = 'PAUSED';
    protected $appends = ['StartTime', 'EndTime'];

    static function getAllStatus(): array
    {
        return [self::START, self::PAUSED, self::RESTART, self::END];
    }

    protected $fillable = ['task_worker_id', 'status', 'time'];

    public function getStartTimeAttribute()
    {
        return $this->where('status', '=', self::START);
    }

    public function getEndTimeAttribute()
    {
        return $this->where('status', '=', self::END);
    }
}
