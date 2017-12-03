<?php

namespace App\Listeners;

use App\Events\ResendRequest;
use App\Mail\ConfirmRegistration;
use Illuminate\Auth\Events\Registered;
use Illuminate\Events\Dispatcher;


class MailNotifier
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  Registered  $event
     * @return void
     */
    public function onRegistered(Registered $event): void
    {
        \Mail::to($event->user)->send(new ConfirmRegistration($event->user));
    }

    public function onResendRequest(ResendRequest $event): void
    {

        \Mail::to($event->user)->send(new ConfirmRegistration($event->user));
    }


    public function subscribe(Dispatcher $events)
    {
        $events->listen(
            Registered::class,
            static::class . '@onRegistered'
        );

        $events->listen(
            ResendRequest::class,
            static::class . '@onResendRequest'
        );
    }
}
