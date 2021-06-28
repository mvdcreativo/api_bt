<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
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
        'nationality_id',
        'surgery_institution_id',
        'registroH',
        'medical_institution_id',
        'doctor_id',
        'derived_by_id',
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

    public function derived_by()
    {
        return $this->belongsTo('App\Models\Doctor', 'derived_by_id');
    }  

    public function medical_institution()
    {
        return $this->belongsTo('App\Models\MedicalInstitution');
    }

    public function surgery_institution()
    {
        return $this->belongsTo('App\Models\MedicalInstitution', 'surgery_institution_id');
    }

    public function documents()
    {
        return $this->belongsToMany('App\Models\Document');
    }

    public function city()
    {
        return $this->belongsTo('App\Models\City')->with('state');
    }

    public function nationality()
    {
        return $this->belongsTo('App\Models\Country', 'nationality_id');
    }

    public function families()
    {
        return $this->belongsToMany('App\Models\Family', 'family_kinship_patient');
    }

    public function kinships()
    {
        return $this->belongsToMany('App\Models\Kinship', 'family_kinship_patient');
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

        if($filter){

                $query
                ->where('name', "LIKE", '%'.trim($filter).'%')
                ->orWhere('last_name', "LIKE", '%'.trim($filter).'%')
                ->orWhere('n_doc', "LIKE", '%'.trim($filter).'%')
                ->orWhere('phone', "LIKE", '%'.trim($filter).'%')
                ->orWhere('email', "LIKE", '%'.trim($filter).'%')
                ->orWhere('id', "LIKE", '%'.trim($filter).'%')
                ->orWhere('code', "LIKE", '%'.trim($filter).'%')
                ->orWhereHas('medical_institution', function(Builder $q) use ($filter){
                    $q->where('name', "LIKE", '%'.trim($filter).'%');
                });
                return $query;
            

        }
    }
    public function scopeCode_exist($query, $filter)
    {
        if(isset($filter)){
            return $query
                ->where('code', $filter);
        }
        return $query;
    }
    public function scopeN_doc_exist($query, $filter)
    {
        if(isset($filter)){
            return $query
                ->where('n_doc', $filter);
        }

        return $query;

    }


}
