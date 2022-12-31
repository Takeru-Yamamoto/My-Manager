<?php

namespace App\Consts;

class MailConst
{
    public const EXPIRATION_MINUTE = 30;

    public const SUBJECT_HEAD = "[Laravel CMS]";

    public const SYSTEM_ALERT    = "systemAlert";
    public const PASSWORD_FORGOT = "passwordForgot";
    public const EMAIL_RESET     = "emailReset";

    public const SYSTEM_ALERT_SUBJECT    = "System Alert";
    public const PASSWORD_FORGOT_SUBJECT = "パスワード変更のお知らせ";
    public const EMAIL_RESET_SUBJECT     = "メールアドレス変更のお知らせ";

    public const SUBJECTS = [
        self::SYSTEM_ALERT    => self::SUBJECT_HEAD . self::SYSTEM_ALERT_SUBJECT,
        self::PASSWORD_FORGOT => self::SUBJECT_HEAD . self::PASSWORD_FORGOT_SUBJECT,
        self::EMAIL_RESET     => self::SUBJECT_HEAD . self::EMAIL_RESET_SUBJECT,
    ];
}
