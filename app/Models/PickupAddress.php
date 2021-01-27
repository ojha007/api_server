<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class PickupAddress extends Model
{

    protected $table = 'pickup_address';
    public $timestamps = false;
    protected $with = ['state'];
    protected $fillable = ['state_id', 'city', 'postal_code', 'street_one', 'street_two', 'enquiry_id'];

    public function state(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(State::class);
    }
}
