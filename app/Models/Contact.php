<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    //
    protected $table = "contact";
    protected $fillable = [
        'city',
        'address',
        'no_hp',
        'email',
        'open_hours',
        'gmaps',
    ];
}