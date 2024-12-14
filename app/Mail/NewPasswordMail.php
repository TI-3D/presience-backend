<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    public $password,$name;

    public function __construct($password,$name)
    {
        $this->password = $password;
        $this->name = $name;
    }

    public function build()
    {
        return $this->subject('Lupa Password - Berhasil')
            ->view('emails.new-password')
            ->with(['password' => $this->password, 'name' =>$this->name]);
    }
}
