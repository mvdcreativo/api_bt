<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'birth',
        'type_doc',
        'n_doc',
        'name',
        'last_name',
        'phone',
        'address',
        'email',
        'ashkenasi',
        'gender',
        'type_patient',
        'city_id',
        'medical_institution_id',
        'doctor_id',
        'breed_id',
        'obs'
    ];

    ///////////RELATIONSHIP

    public function patient_data()
    {
        return $this->hasOne('App\Models\PatientData');
    }

    public function breed()
    {
        return $this->belongsTo('App\Models\Breed');
    }

    public function doctor()
    {
        return $this->belongsTo('App\Models\Doctor');
    }

    public function medical_institution()
    {
        return $this->belongsTo('App\Models\MedicalInstitution');
    }

    public function documents()
    {
        return $this->belongsToMany('App\Models\Document');
    }

    public function city()
    {
        return $this->belongsTo('App\Models\City')->with('state');
    }

    public function families()
    {
        return $this->belongsToMany('App\Models\Family');
    }

    public function kinships()
    {
        return $this->belongsToMany('App\Models\Kinship');
    }
    
    public function evolutions()
    {
        return $this->belongsToMany('App\Models\Evolution');
    }

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
                ->orWhere('name', "LIKE", '%'.$filter.'%')
                ->orWhere('id', "LIKE", '%'.$filter.'%');
    }
    public function scopeCode_exist($query, $filter)
    {
        if($filter){
            return $query
                ->where('code', $filter);
        }
        return $query;
    }
    public function scopeN_doc_exist($query, $filter)
    {
        if($filter){
            return $query
                ->where('n_doc', $filter);
        }

        return $query;

    }


}
