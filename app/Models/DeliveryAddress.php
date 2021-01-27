<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class DeliveryAddress extends Model
{
    public $timestamps = false;
    protected $table = 'delivery_address';
    protected $with = ['state'];
    protected $fillable = ['state_id', 'city', 'postal_code', 'street_one', 'street_two', 'enquiry_id'];

    public function state(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(State::class);
    }
}
