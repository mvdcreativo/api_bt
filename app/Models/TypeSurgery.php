<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeSurgery extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];


    public function patient_data()
    {
        return $this->hasMany('App\Models\PatientData');
    }
}
