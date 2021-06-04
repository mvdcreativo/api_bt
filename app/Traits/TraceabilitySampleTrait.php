<?php

namespace App\Traits;

use App\Models\Estadio;
use App\Models\Tnm;
use App\Models\Traceability;
use App\Models\TumorLineage;
use App\Models\TypeSample;
use Illuminate\Support\Facades\Auth;

trait TraceabilitySampleTrait
{
    protected function track($model, callable $func = null, $sample_id = null)
    {
        $id = $sample_id ?: $model->id;
        // Allow for customization of the history record if needed
        $func = $func ?: [$this, 'getHistoryBody'];

        // Get the dirty fields and run them through the custom function, then insert them into the history table
        $this->getUpdated($model)
            ->map(function ($value, $field) use ($func) {
                return call_user_func_array($func, [$value, $field]);
            })
            ->each(function ($fields) use ($id) {
                Traceability::create([
                    'user_name' => Auth::user()->name . " " . Auth::user()->last_name,
                    'sample_id' => $id,
                    // 'stage_id'  => Auth::user()->id,                    // obs'  => $id,
                ] + $fields);
            });
    }

    protected function getHistoryBody($value, $field)
    {
        return [
            'body' => "Updated {$field} to ${value}",
        ];
    }

    protected function getUpdated($model)
    {
        return collect($model->getDirty())->filter(function ($value, $key) {
            // We don't care if timestamps are dirty, we're not tracking those
            return !in_array($key, ['created_at', 'updated_at']);
        })->mapWithKeys(function ($value, $key) {
            // Take the field names and convert them into human readable strings for the description of the action
            // e.g. first_name -> first name
            return self::traslateFields($key, $value);
            // return [str_replace('_', ' ', $key) => $value];
        });
    }

    static private function traslateFields($key, $value)
    {
        switch ($key) {
            case "type_sample_id":
                $v = TypeSample::find($value)->name;
                return ["Tipo de muestra" => $v];
                break;
            case "tumor_lineage_id":
                $v = TumorLineage::find($value)->name;
                return ["Estirpe Tumoral" => $v];
                break;
            case "tnm_id":
                $v = Tnm::find($value)->name;
                return ["TNM" => $v];
                break;
            case "topography_id":
                $v = Tnm::find($value)->name;
                return ["Topocrafía" => $v];
                break;
            case "trat_q":
                return ["Tratamiento quirúrgico" => $value ? "true" : "false"];
                break;
            case "trat_q_date":
                return ["Fecha tratamiento quirúrgico" => $value];
                break;
            case "trat_q_criterio":
                return ["Creiterio tratamiento quirúrgico" => $value];
                break;
            case "trat_q_plan":
                return ["Plan tratamiento quirúrgico" => $value];
                break;

            case "radio_t":
                return ["Radio Terapia" => $value ? "true" : "false"];
                break;
            case "radio_t_date":
                return ["Fecha Radio Terapia" => $value];
                break;
            case "radio_t_criterio":
                return ["Creiterio Radio Terapia" => $value];
                break;
            case "radio_t_plan":
                return ["Plan Radio Terapia" => $value];
                break;

            case "quimio":
                return ["Quimioterapia" => $value ? "true" : "false"];
                break;
            case "quimio_date":
                return ["Fecha Quimioterapia" => $value];
                break;
            case "quimio_criterio":
                return ["Creiterio Quimioterapia" => $value];
                break;
            case "quimio_plan":
                return ["Plan Quimioterapia" => $value];
                break;

            case "homo":
                return ["Hormonoterapia" => $value ? "true" : "false"];
                break;
            case "homo_date":
                return ["Fecha Hormonoterapia" => $value];
                break;
            case "homo_criterio":
                return ["Creiterio Hormonoterapia" => $value];
                break;
            case "homo_plan":
                return ["Plan Hormonoterapia" => $value];
                break;

            case "terapia_bio":
                return ["Terapia Biológica" => $value ? "true" : "false"];
                break;
            case "terapia_bio_date":
                return ["Fecha Terapia Biológica" => $value];
                break;
            case "terapia_bio_criterio":
                return ["Creiterio Terapia Biológica" => $value];
                break;
            case "terapia_bio_plan":
                return ["Plan Terapia Biológica" => $value];
                break;

            case "otros":
                return ["Otros" => $value ? "true" : "false"];
                break;
            case "otros_date":
                return ["Fecha Otros" => $value];
                break;
            case "otros_criterio":
                return ["Creiterio Otros" => $value];
                break;
            case "otros_plan":
                return ["Plan Otros" => $value];
                break;

            case "estadio_id":
                $v = Estadio::find($value)->name;
                return ["Estadio" => $v];
                break;

            case "anatomia":
                return ["Anatomía Patológica" => $value ? "true" : "false"];
                break;
            case "anatomia_date":
                return ["Fecha Anatomía Patológica" => $value];
                break;

            case "biopsia":
                return ["Biopsia" => $value ? "true" : "false"];
                break;

            case "reseccion_q":
                return ["A partir de resección Q" => $value ? "true" : "false"];
                break;

            case "con_cancer":
                return ["Paciente con cancer" => $value ? "true" : "false"];
                break;

            case "operacion":
                return ["Opercaión" => $value];
                break;

            case "isquemia_min":
                return ["Isquemia Min." => $value];
                break;

            case "isquemia_seg":
                return ["Isquemia Seg." => $value];
                break;

            case "tacos_cant":
                return ["Cantidad de tacos" => $value];
                break;
            case "laminas_cant":
                return ["Cantidad de láminas" => $value];
                break;
            case "necrosis_tumoral_cant":
                return ["Porcentaje de necrósis" => $value];
                break;
            case "obs":
                return ["Observaciones Anatomopatológicas" => $value];
                break;

            case "code":
                return ["Código" => $value];
                break;

            case "name":
                return ["Nombre" => $value];
                break;

            case "volume":
                return ["Volúmen" => $value];
                break;

            default:
                return [$key => $value];
        }
    }
}
