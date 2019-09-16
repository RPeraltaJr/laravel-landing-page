<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    // allow updating the following fields
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
        'confirm',
        'status',
        'notes',
    ];

    public function path() {
        return "/submissions/{$this->id}";
    }
}
