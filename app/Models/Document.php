<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'name_file',
        'url_file',
    ];

    public function patients()
    {
        return $this->belongsToMany('App\Models\Patient');
    }



    ////////////SCOPES////////

    public function scopePatient_id($query, $filter)
    {
        if($filter)
            return $query
            ->whereHas('patients', function(Builder $q) use ($filter){
                $q->where('patient_id', $filter);
            });
    }

    public function scopeFilter($query, $filter)
    {
        if($filter)
            return $query
            ->orWhere('name', "LIKE", '%'.$filter.'%')
            ->orWhere('name_file', "LIKE", '%'.$filter.'%')
            ->orWhere('url_file', "LIKE", '%'.$filter.'%');
    }


}
