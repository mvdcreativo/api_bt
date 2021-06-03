<?php

namespace App\Observers;

use App\Models\SampleData;
use App\Traits\TraceabilitySampleTrait;

class SampleDataObserver
{

    use TraceabilitySampleTrait;

    /**
     * Handle the SampleData "created" event.
     *
     * @param  \App\Models\SampleData  $sampleData
     * @return void
     */
    public function created(SampleData $sampleData)
    {
        //
    }

    /**
     * Handle the SampleData "updated" event.
     *
     * @param  \App\Models\SampleData  $sampleData
     * @return void
     */
    public function updated(SampleData $sampleData)
    {
        $this->track($sampleData, function ($value, $field) {
            return [
                'body' => "Actualiza campo {$field} a ${value}",
            ];
        });
    }

    /**
     * Handle the SampleData "deleted" event.
     *
     * @param  \App\Models\SampleData  $sampleData
     * @return void
     */
    public function deleted(SampleData $sampleData)
    {
        //
    }

    /**
     * Handle the SampleData "restored" event.
     *
     * @param  \App\Models\SampleData  $sampleData
     * @return void
     */
    public function restored(SampleData $sampleData)
    {
        //
    }

    /**
     * Handle the SampleData "force deleted" event.
     *
     * @param  \App\Models\SampleData  $sampleData
     * @return void
     */
    public function forceDeleted(SampleData $sampleData)
    {
        //
    }
}
