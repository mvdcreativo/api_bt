<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SampleData extends Model
{
    use HasFactory;

    protected $fillable = [
        'sample_id',
        'trat_q',
        'trat_q_date',
        'trat_q_criterio',
        'trat_q_plan',
        'radio_t',
        'radio_t_date',
        'radio_t_criterio',
        'radio_t_plan',
        'quimio',
        'quimio_date',
        'quimio_criterio',
        'quimio_plan',
        'homo',
        'homo_date',
        'homo_criterio',
        'homo_plan',
        'terapia_bio',
        'terapia_bio_date',
        'terapia_bio_criterio',
        'terapia_bio_plan',
        'otros',
        'otros_date',
        'otros_criterio',
        'otros_plan',
    ];

    public function sample()
    {
        return $this->belongsTo('App\Models\Sample');
    }

}
