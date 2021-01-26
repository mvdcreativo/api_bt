<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tnm extends Model
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
