<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    protected $fillable = [
        'first_name',
        'last_name',
        'city',
        'state',
        'zipcode',
        'email',
        'phone',
        'cdla',
        'experience',
        'confirm'
    ];
}
