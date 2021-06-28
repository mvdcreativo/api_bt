<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicalInstitution extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'serie'
    ];


    public function patients()
    {
        return $this->hasMany('App\Models\Patient');
    }


    /////////////////////////////
        ///SCOPES
    /////////////////////////////

    public function scopeFilter($query, $filter)
    {
        if($filter)
            return $query
                ->orWhere('name', "LIKE", '%'.$filter.'%')
                ->orWhere('id', "LIKE", '%'.$filter.'%');
    }
}
