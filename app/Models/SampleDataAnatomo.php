<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SampleDataAnatomo extends Model
{
    use HasFactory;

    protected $fillable = [
        'sample_id',
        'estadio_id',
        'anatomia',
        'anatomia_date',
        'biopsia',
        'reseccion_q',
        'con_cancer',
        'type_surgery_id',
        'operacion',
        'isquemia_min',
        'isquemia_seg',
        'tacos_cant',
        'laminas_cant',
        'necrosis_tumoral_cant',
        'obs'
    ];


    public function sample()
    {
        return $this->belongsTo('App\Models\Sample');
    }

    public function estadio()
    {
        return $this->belongsTo('App\Models\Estadio');
    }

    public function type_surgery()
    {
        return $this->belongsTo('App\Models\TypeSurgery');
    }
}
