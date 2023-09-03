<?php

namespace App\Http\Controllers;

use App\Jobs\SendEmail;
use Illuminate\Http\Request;

class QueueEmails extends Controller
{
    /**
     * test email queues
     **/
    public function sendTestEmails()
    {
        $emailJobs = new SendEmail();
        $this->dispatch($emailJobs);
    }
}
