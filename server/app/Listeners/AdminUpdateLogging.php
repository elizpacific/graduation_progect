<?php

namespace App\Listeners;

use App\Events\AdminUpdate;
use App\Mail\AdminUpdated;
use App\Models\Admin;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class AdminUpdateLogging
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
    public function handle(AdminUpdate $event)
    {
        Mail::to(Admin::first())->send(new AdminUpdated($event->admin));
    }
}
