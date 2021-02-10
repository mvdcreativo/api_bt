<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
    ];


    ////RELATIONSHIPS

    public function states()
    {
        return $this->hasMany('App\Mondels\State');
    }


    /////////////////////////////
        ///SCOPES
    /////////////////////////////

    public function scopeFilter($query, $filter)
    {
        if($filter)
            return $query
                ->orWhere('name', "LIKE", '%'.$filter.'%')
                ->orWhere('code', "LIKE", '%'.$filter.'%')
                ->orWhere('id', "LIKE", '%'.$filter.'%');
    }
}
