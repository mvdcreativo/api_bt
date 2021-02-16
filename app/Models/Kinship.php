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
        return $this->belongsToMany('App\Models\Patient', 'family_kinship_patient');
    }

    public function families()
    {
        return $this->belongsToMany('App\Models\Family', 'family_kinship_patient');
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
