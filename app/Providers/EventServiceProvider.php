<?php

namespace App\Providers;

use App\Models\Sample;
use App\Models\SampleData;
use App\Models\SampleDataAnatomo;
use App\Models\Tube;
use App\Observers\SampleDataAnatomoObserver;
use App\Observers\SampleDataObserver;
use App\Observers\SampleObserver;
use App\Observers\TubeObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        Sample::observe(SampleObserver::class);
        Tube::observe(TubeObserver::class);
        SampleData::observe(SampleDataObserver::class);
        SampleDataAnatomo::observe(SampleDataAnatomoObserver::class);
    }
}
