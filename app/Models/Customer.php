<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Customer extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'phone',
        'address',
        'address1',
        'city',
        'state',
        'zip',
        'f_name',
        'l_name',
        'email'
    ];

}
