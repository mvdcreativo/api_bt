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
        return $this->belongsTo('App\Models\City');
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



}
