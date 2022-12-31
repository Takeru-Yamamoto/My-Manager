<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

use App\Consts\MailConst;

class MyMail extends Mailable
{
    use Queueable, SerializesModels;

    private string $viewName;
    private array $data;
    private string $subject;

    public function __construct(string $viewName, array $data)
    {
        $this->viewName = $viewName;
        $this->data = $data;

        if (isset(MailConst::SUBJECTS[$viewName])) {
            $this->subject = MailConst::SUBJECTS[$viewName];
        } else {
            $this->subject = "";
        }
    }

    public function build()
    {
        return $this->view("emails." . $this->viewName)
            ->subject($this->subject)
            ->from(config("mail.from.address"), config("mail.from.name"))
            ->with($this->data);
    }
}
