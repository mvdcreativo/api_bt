<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kinship extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function patients()
    {
        return $this->belongsToMany('App\Models\Patient');
    }

    public function families()
    {
        return $this->belongsToMany('App\Models\Family');
    }
}
