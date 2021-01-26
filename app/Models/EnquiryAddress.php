<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class EnquiryAddress extends Model
{

    protected $table = 'enquiry_address';
    public $timestamps = false;
    protected $fillable = ['state_id', 'city', 'postal_code', 'street_one', 'street_two', 'enquiry_id'];
}
