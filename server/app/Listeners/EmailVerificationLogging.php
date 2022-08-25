<?php

namespace App\Listeners;

use App\Mail\EmailVerificated;
use App\Events\EmailVerification;
use App\Models\Admin;
use Illuminate\Support\Facades\Mail;

class EmailVerificationLogging
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

    public function handle(EmailVerification $event)
    {
        Mail::to($event->admin)->send(new EmailVerificated($event->admin));
    }
}
