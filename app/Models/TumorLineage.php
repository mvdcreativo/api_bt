<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TumorLineage extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];


    public function samples()
    {
        return $this->hasMany('App\Models\Sample');
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
}
