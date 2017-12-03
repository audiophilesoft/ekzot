<?php

namespace App\Providers;

use App\Listeners\AdminNotifier;
use App\Listeners\MailNotifier;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        //
    ];

    /**
     * The subscriber classes to register.
     *
     * @var array
     */
    protected $subscribe = [
        MailNotifier::class,
        AdminNotifier::class
    ];
    /** @noinspection SenselessProxyMethodInspection */


    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
