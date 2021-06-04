<?php

namespace App\Observers;

use App\Models\Tube;
use App\Traits\TraceabilitySampleTrait;

class TubeObserver
{
    use TraceabilitySampleTrait;

    /**
     * Handle the Tube "created" event.
     *
     * @param  \App\Models\Tube  $tube
     * @return void
     */
    public function created(Tube $tube)
    {
        $this->track($tube, function ($value, $field) {
            return [
                'body' => "Crea Tubo -> campo {$field} valor ${value}",
            ];
        },$tube->sample_id);
    }

    /**
     * Handle the Tube "updated" event.
     *
     * @param  \App\Models\Tube  $tube
     * @return void
     */
    public function updated(Tube $tube)
    {
        //
    }

    /**
     * Handle the Tube "deleted" event.
     *
     * @param  \App\Models\Tube  $tube
     * @return void
     */
    public function deleted(Tube $tube)
    {
        //
    }

    /**
     * Handle the Tube "restored" event.
     *
     * @param  \App\Models\Tube  $tube
     * @return void
     */
    public function restored(Tube $tube)
    {
        //
    }

    /**
     * Handle the Tube "force deleted" event.
     *
     * @param  \App\Models\Tube  $tube
     * @return void
     */
    public function forceDeleted(Tube $tube)
    {
        //
    }
}
