<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

use Throwable;

class SystemAlert extends Mailable
{
    use Queueable, SerializesModels;

    private Throwable $throwable;
    private string $subject;

    public function __construct(Throwable $throwable)
    {
        $this->throwable = $throwable;
        $this->subject   = config("email.subject_head") . config("email.subject.systemAlert");
    }

    public function build()
    {
        $data = [
            "throwable" => $this->throwable
        ];

        return $this->view("emails.systemAlert")
            ->subject($this->subject)
            ->from(config("mail.sys_alert.from.address"), config("mail.sys_alert.from.name"))
            ->with($data);
    }
}
