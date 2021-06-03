<?php

namespace App\Observers;

use App\Models\Sample;
use App\Traits\TraceabilitySampleTrait;

class SampleObserver
{
    // public $afterCommit = true;

    use TraceabilitySampleTrait;

    public function created(Sample $sample)
    {
        //
    }

    /**
     * Handle the Sample "updated" event.
     *
     * @param  \App\Models\Sample  $sample
     * @return void
     */
    public function updated(Sample $sample)
    {
        $this->track($sample, function ($value, $field) {
            return [
                'body' => "Actualiza campo {$field} a ${value}",
            ];
        });

    }

    /**
     * Handle the Sample "deleted" event.
     *
     * @param  \App\Models\Sample  $sample
     * @return void
     */
    public function deleted(Sample $sample)
    {
        //
    }

    /**
     * Handle the Sample "restored" event.
     *
     * @param  \App\Models\Sample  $sample
     * @return void
     */
    public function restored(Sample $sample)
    {
        //
    }

    /**
     * Handle the Sample "force deleted" event.
     *
     * @param  \App\Models\Sample  $sample
     * @return void
     */
    public function forceDeleted(Sample $sample)
    {
        //
    }
}
