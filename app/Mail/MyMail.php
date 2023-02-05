<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MyMail extends Mailable
{
    use Queueable, SerializesModels;

    private string $viewName;
    private array $data;
    private string $subject;

    public function __construct(string $viewName, array $data)
    {
        $this->viewName = $viewName;
        $this->data     = $data;

        $this->subject = isset(config("email.subject")[$viewName]) ? config("email.subject_head") . config("email.subject")[$viewName] : "";
    }

    public function build()
    {
        return $this->view("emails." . $this->viewName)
            ->subject($this->subject)
            ->from(config("mail.from.address"), config("mail.from.name"))
            ->with($this->data);
    }
}
