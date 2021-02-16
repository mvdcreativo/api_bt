<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
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
        return $this->belongsToMany('App\Models\Patient', 'family_kinship_patient');
    }

    public function kinships()
    {
        return $this->belongsToMany('App\Models\Kinship', 'family_kinship_patient');
    }



        /////////////////////////////
        ///SCOPES
    /////////////////////////////

    public function scopeFilter($query, $filter)
    {
        if($filter)
            return $query
            ->where('code', $filter);
    }

    public function scopePatient_id($query, $filter)
    {
        if($filter){
            return $query
            // ->where('patient_id', $filter)
            ->whereHas('patients', function(Builder $q) use ($filter){
                $q->where('patient_id', $filter);
            });
        }
    }


}
