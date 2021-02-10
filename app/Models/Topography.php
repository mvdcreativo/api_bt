<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topography extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'cie10'
    ];


    public function samples()
    {
        return $this->hasMany('App\Models\Sample');
    }

    public function patient_data()
    {
        return $this->hasMany('App\Models\PatientData');
    }

    public function anterior_patient_data()
    {
        return $this->hasMany('App\Models\PatientData');
    }




    /////////////////////////////
        ///SCOPES
    /////////////////////////////

    public function scopeFilter($query, $filter)
    {
        if($filter)
            return $query
            ->orWhere('name', "LIKE", '%'.$filter.'%')
            ->orWhere('cie10', "LIKE", '%'.$filter.'%');
            // ->orWhere('id', "LIKE", '%'.$filter.'%');
    }
}
