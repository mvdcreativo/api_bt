<?php

namespace App\Observers;

use App\Models\SampleDataAnatomo;
use App\Traits\TraceabilitySampleTrait;

class SampleDataAnatomoObserver
{
    use TraceabilitySampleTrait;

    /**
     * Handle the SampleDataAnatomo "created" event.
     *
     * @param  \App\Models\SampleDataAnatomo  $sampleDataAnatomo
     * @return void
     */
    public function created(SampleDataAnatomo $sampleDataAnatomo)
    {
        //
    }

    /**
     * Handle the SampleDataAnatomo "updated" event.
     *
     * @param  \App\Models\SampleDataAnatomo  $sampleDataAnatomo
     * @return void
     */
    public function updated(SampleDataAnatomo $sampleDataAnatomo)
    {
        $this->track($sampleDataAnatomo, function ($value, $field) {
            return [
                'body' => "Actualiza campo {$field} a ${value}",
            ];
        });
    }

    /**
     * Handle the SampleDataAnatomo "deleted" event.
     *
     * @param  \App\Models\SampleDataAnatomo  $sampleDataAnatomo
     * @return void
     */
    public function deleted(SampleDataAnatomo $sampleDataAnatomo)
    {
        //
    }

    /**
     * Handle the SampleDataAnatomo "restored" event.
     *
     * @param  \App\Models\SampleDataAnatomo  $sampleDataAnatomo
     * @return void
     */
    public function restored(SampleDataAnatomo $sampleDataAnatomo)
    {
        //
    }

    /**
     * Handle the SampleDataAnatomo "force deleted" event.
     *
     * @param  \App\Models\SampleDataAnatomo  $sampleDataAnatomo
     * @return void
     */
    public function forceDeleted(SampleDataAnatomo $sampleDataAnatomo)
    {
        //
    }
}
