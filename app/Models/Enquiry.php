<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Enquiry extends Model
{

    protected $fillable = ['name',
        'phone',
         'email',
         'title',
         'description',
         'quotation_id',
         'user_id'
    ];

    protected $hidden = ['created_at', 'deleted_at', 'updated_at'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function quotation(): BelongsTo
    {
        return $this->belongsTo(Quotation::class);

    }
}

