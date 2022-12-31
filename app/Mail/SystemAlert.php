<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

use Throwable;

use App\Consts\MailConst;

class SystemAlert extends Mailable
{
    use Queueable, SerializesModels;

    private Throwable $throwable;

    public function __construct(Throwable $throwable)
    {
        $this->throwable = $throwable;
    }

    public function build()
    {
        $data = [
            "throwable" => $this->throwable
        ];

        return $this->view("emails.systemAlert")
            ->subject(MailConst::SYSTEM_ALERT_SUBJECT)
            ->from(config("mail.sys_alert.from.address"), config("mail.sys_alert.from.name"))
            ->with($data);
    }
}
