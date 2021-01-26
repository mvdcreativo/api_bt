<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estadio extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function sample_data_anatomos()
    {
        return $this->hasMany('App\Models\SampleDataAnatomos');
    }

}
