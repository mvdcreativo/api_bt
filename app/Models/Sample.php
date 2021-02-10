<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sample extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'patient_id',
        'type_sample_id',
        'tumor_lineage_id',
        'tnm_id',
        'topography_id',
    ];


    public function patient()
    {
        return $this->belongsTo('App\Models\Patient');
    }
    
    public function type_sample()
    {
        return $this->belongsTo('App\Models\TypeSample');
    }
        
    public function tumor_lineage()
    {
        return $this->belongsTo('App\Models\TumorLineage');
    }
            
    public function tnm()
    {
        return $this->belongsTo('App\Models\Tnm');
    }
                
    public function topography()
    {
        return $this->belongsTo('App\Models\Topography');
    }

    public function sample_data()
    {
        return $this->hasOne('App\Models\SampleData');
    }

    public function sample_data_anatomo()
    {
        return $this->hasOne('App\Models\SampleDataAnatomo');
    }

    public function stages()
    {
        return $this->belongsToMany('App\Models\Stage');
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
}
