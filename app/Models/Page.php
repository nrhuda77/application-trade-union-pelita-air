<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    //
    protected $fillable = [
        'title',
        'slug',
        'banner',
        'meta_title',
        'meta_desc',
        'content',
        'is_active',
    ];
}
