<?php

namespace App\Jobs;

use App\Mail\SendPasswordEmail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use App\Models\User;
use Illuminate\Mail\Mailer;
use Illuminate\Support\Facades\Mail;

class SendPasswordJob implements ShouldQueue
{
    use Queueable;

    public $user;
    public $password;

    public function __construct(User $user, $password)
    {
        $this->user = $user;
        $this->password = $password;
    }

    public function handle(Mailer $mailer)
    {
        Mail::to($this->user->email)->send(new SendPasswordEmail($this->user, $this->password));
    }
}
