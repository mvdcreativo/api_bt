<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Family extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
    ];

    public function patients()
    {
        return $this->belongsToMany('App\Models\Patient');
    }

    public function kinships()
    {
        return $this->belongsToMany('App\Models\Kinship');
    }



}
