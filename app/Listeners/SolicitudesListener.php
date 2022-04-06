<?php

namespace App\Listeners;
use App\Models\User;
use App\Notifications\solicitudesn;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;


class SolicitudesListener
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
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        /*       User::all()
        ->except($Solicitude->id)
         ->each(function(User $user) use ($Solicitude){
            $user->notify(new solicitudesn($Solicitude));
        });*/
        User::all()
        ->except($event->Solicitude->id)
        ->each(function(User $user) use ($event){
            Notification::send($user, new  solicitudesn($event->Solicitude));
        });
    }
}
