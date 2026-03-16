<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    //
    protected $fillable = [
        'unit_name',
        'slug',
        'description',
        'structure_image',
        'banner',
        'is_active',
    ];
}
