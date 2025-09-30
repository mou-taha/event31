<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;

    public $name, $email, $msg;

    // On hydrate $name, $email et $msg
    public function __construct($name, $email, $msg)
    {
        $this->name = $name;
        $this->email = $email;
        $this->msg = $msg;
    }

    public function build()
    {
        // On retourne le sujet et la  vue
        return $this->subject('Contact depuis mon site')->view('mails.contact-mail');
    }
}