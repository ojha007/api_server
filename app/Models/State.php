<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class State extends Model
{

    protected $table = 'states';
    protected $with = ['country'];

    public function country(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Country::class);
    }
}
