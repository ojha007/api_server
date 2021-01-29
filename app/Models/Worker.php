<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Worker extends Model
{

    const CODE = 'W';
    protected $table = 'workers';
    protected $fillable = ['name', 'email', 'description', 'phone', 'code'];

}
