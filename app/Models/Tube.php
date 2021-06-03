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
        'sample_id',
    ];

    public function sample()
    {
        return $this->belongsTo('App\Models\Sample');
    }

    public function traceabilities()
    {
        return $this->hasMany(Traceability::class);
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
