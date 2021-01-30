<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Enquiry extends Model
{

    protected $fillable = ['first_name', 'last_name',
        'mobile_number', 'email', 'address1', 'address2',
        'city', 'state', 'postal_code', 'pickup_date',
        'delivery_date', 'optional_number', 'age', 'comment', 'user_id'
    ];

    protected $hidden = ['created_at', 'deleted_at', 'updated_at'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}

