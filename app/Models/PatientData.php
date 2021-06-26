<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientData extends Model
{
    use HasFactory;
    protected $fillable = [
        'patient_id',
        'date_surgery',
        'topography_id',
        'type_surgery_id',
        'imc',
        'imc_talla',
        'imc_peso',
        'imc_imc',
        'fumador',
        'fumador_activo',
        'fumador_cant',
        'alcoholista',
        'alcoholista_activo',
        'alcoholista_cant',       
        'drogas',
        'drogas_activo',
        'drogas_tipo',       
        'rt',
        'rt_donde',
        'rt_date',
        'anticonceptivos',
        'anticonceptivos_periodo',
        'amamantar',
        'amamantar_periodo',
        'hormonas',
        'hormonas_periodo',
        'ambientales',
        'ambientales_cuales',
        'mamografia',
        'mamografia_frecuencia',
        'mamografia_otros',
        'mamografia_date_ultima',
        'pap',
        'pap_frecuencia',
        'pap_otros',
        'pap_date_ultima',
        'edad_menarca',
        'edad_primer_emb',
        'menopausia_edad',
        'menopausia_quirurgica',
        'antecedente',
        'antecedente_directo',
        'antecedente_directo_tipo',
        'antecedente_indirectos',
        'antecedente_indirectos_tipo',
        'anterior',
        'anterior_topography_id',
        'anterior_edad',

    ];


    public function patient()
    {
        return $this->belongsTo('App\Models\Patient');
    }

    public function topography()
    {
        return $this->belongsTo('App\Models\Topography');
    }

    public function anterior_topography()
    {
        return $this->belongsTo('App\Models\Topography', 'anterior_topography_id');
    }

    public function type_surgery()
    {
        return $this->belongsTo('App\Models\TypeSurgery');
    }

}
