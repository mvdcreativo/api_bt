<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estadio extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function sample_data_anatomos()
    {
        return $this->hasMany('App\Models\SampleDataAnatomos');
    }


    /////////////////////////////
        ///SCOPES
    /////////////////////////////

    public function scopeFilter($query, $filter)
    {
        if($filter)
            return $query
            ->where('name', "LIKE", '%'.$filter.'%')
            ->orWhere('id', "LIKE", '%'.$filter.'%');
    }
}
