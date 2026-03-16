<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Anggota extends Authenticatable 
{
    use HasFactory;
    protected $table = "anggota";
    protected $guarded = ['id'];
    public $timestamps = true; 

    public function getAuthIdentifierName()
    {
        return 'id';
    }

 
    public function getAuthPassword()
    {
        return $this->password; 
    }
}