<?php

namespace App\Listeners;

use App\Events\CommentAdded;
use App\Events\ErrorOccurred;
use App\Mail\Admin\NewUserRegistered;

use Illuminate\Auth\Events\Registered;
use Illuminate\Events\Dispatcher;

class AdminNotifier
{
    public function onRegistered(Registered $event): void
    {
        \Mail::to(config('site.admin.mail'))->send(new NewUserRegistered($event->user));
    }


    public function onCommentAdded(CommentAdded $event): void
    {
        if ($event->comment->user->isAdmin()) {
            return;
        }

        \Mail::to(config('site.admin.mail'))->send(new \App\Mail\Admin\CommentAdded($event->comment));
    }


    public function onErrorOccurred(ErrorOccurred $event): void
    {
        \Mail::to(config('site.admin.mail'))->send(new \App\Mail\Admin\ErrorOccurred($event->error));
    }


    public function subscribe(Dispatcher $events): void
    {
        $events->listen(
            Registered::class,
            static::class . '@onRegistered'
        );

        $events->listen(
            CommentAdded::class,
            static::class . '@onCommentAdded'
        );
        $events->listen(
            ErrorOccurred::class,
            static::class . '@onErrorOccurred'
        );
    }
}
