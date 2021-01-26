<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tube extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'volume',
        'sample_id'
    ];

    public function sample()
    {
        return $this->belongsTo('App\Models\Sample');
    }

    
}
