<?php

namespace App\Traits;

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
            default:
                return [$key => $value];
        }
    }
}
