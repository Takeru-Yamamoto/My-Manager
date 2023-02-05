<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Illuminate\Support\Facades\Mail;
use App\Mail\SystemAlert;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            if (empty(config("email.system_alert.to.address")) || empty(config("email.system_alert.from.address")) || empty(config("email.system_alert.from.name"))) {
                dividerLog();
                infoLog("SYSTEM ALERT CANNOT SEND");
                infoLog("PLEASE CHECK .env AND SET ABOUT SYSTEM ALERT IF YOU WANT TO RECEIVE SYSTEM ALERT");
                dividerLog();

                return true;
            }

            Mail::to(config("email.system_alert.to.address"))->send(new SystemAlert($e));
            return true;
        });
    }
}
