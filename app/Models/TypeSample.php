<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeSample extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];


    public function samples()
    {
        return $this->hasMany('App\Models\Sample');
    }
}
