<?php

namespace App\Listeners;

use App\Events\UserUpdatedEvent;
use App\Mail\UserCreatedEmailNotification;
use App\Mail\UserUpdatedEmailNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendUserUpdatedNotification
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
     * @param  \App\Events\UserUpdatedEvent  $event
     * @return void
     */
    public function handle(UserUpdatedEvent $event)
    {
        $user = $event->user;
        Mail::to($user)->send(new UserUpdatedEmailNotification($user));
    }
}
