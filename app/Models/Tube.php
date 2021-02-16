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

    
    /////////////////////////////
        ///SCOPES
    /////////////////////////////

    public function scopeFilter($query, $filter)
    {
        if($filter)
            return $query
            ->orWhere('name', "LIKE", '%'.$filter.'%');
    }
    
    public function scopeSample_id($query, $filter)
    {
        if($filter)
            return $query
            ->where('sample_id', $filter);
    }
}
