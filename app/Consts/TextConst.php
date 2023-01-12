<?php

namespace App\Consts;

class TextConst
{
    /* common */
    public const KEY_NULL               = "key_null";
    public const KEY_NOT_EXIST          = "key_not_exist";
    public const AUTHENTICATION_FAILURE = "authentication_failure";
    public const FORM_ID_INJUSTICE      = "form_id_injustice";
    public const FORM_EMAIL_INJUSTICE   = "form_email_injustice";

    /* login info */
    public const LOGIN_INFO_UPDATED = "login_info_updated";

    /* password reset */
    public const PASSWORD_RESET_SUCCESS = "password_reset_success";
    public const PASSWORD_RESET_FAILURE = "password_reset_failure";

    /* user */
    public const USER_CREATED    = "user_created";
    public const USER_UPDATED    = "user_updated";
    public const USER_NAME_EXIST = "user_name_exist";

    /* attendance */
    public const ATTENDANCE_CREATED = "attendance_created";

    /* task */
    public const TASK_CREATED        = "task_created";
    public const TASK_UPDATED        = "task_updated";
    public const TASK_DATE_INJUSTICE = "task_date_injustice";
    public const TASK_COLOR_CREATED = "task_color_created";
    public const TASK_COLOR_UPDATED = "task_color_updated";

    /* email */
    public const EMAIL_ADDRESS_EXIST     = "email_address_exist";
    public const EMAIL_ADDRESS_NOT_EXIST = "email_address_not_exist";
    public const EMAIL_SEND_SUCCESS      = "email_send_success";
    public const EMAIL_SEND_FAILURE      = "email_send_failure";
    public const EMAIL_CHANGED_SUCCESS   = "email_changed_success";
    public const EMAIL_CHANGED_EXPIRED   = "email_changed_expired";

    /* import */
    public const IMPORT_ERROR              = "import_error";
    public const IMPORT_VALIDATION_INVALID = "import_validation_invalid";
    public const IMPORT_DATA_EXIST         = "import_data_exist";

    public const TEXTS = [
        self::KEY_NULL                  => "キーがnullです。",
        self::KEY_NOT_EXIST             => "存在しないキーです。",
        self::AUTHENTICATION_FAILURE    => "認証に失敗しました。",
        self::FORM_ID_INJUSTICE         => "IDが不正です。",
        self::FORM_EMAIL_INJUSTICE      => "E-Mailアドレスが不正です。",

        self::LOGIN_INFO_UPDATED        => "ログイン情報を更新しました。",

        self::PASSWORD_RESET_SUCCESS    => "パスワードリセットに成功しました。",
        self::PASSWORD_RESET_FAILURE    => "パスワードリセットに失敗しました。",

        self::USER_CREATED              => "ユーザー情報を登録しました。",
        self::USER_UPDATED              => "ユーザー情報を更新しました。",
        self::USER_NAME_EXIST           => "このユーザ名は既に登録されています。",

        self::ATTENDANCE_CREATED        => "勤怠情報を追加しました。",

        self::TASK_CREATED              => "タスク情報を追加しました。",
        self::TASK_UPDATED              => "タスク情報を変更しました。",
        self::TASK_DATE_INJUSTICE       => "終了日は開始日より後の日付に設定してください。",
        self::TASK_COLOR_CREATED        => "タスク分類を追加しました。",
        self::TASK_COLOR_UPDATED        => "タスク分類を変更しました。",

        self::EMAIL_ADDRESS_EXIST       => "このメールアドレスは既に登録されています。",
        self::EMAIL_ADDRESS_NOT_EXIST   => "このメールアドレスは登録されていません。",
        self::EMAIL_SEND_FAILURE        => "メールの送信に成功しました。",
        self::EMAIL_SEND_FAILURE        => "メールの送信に失敗しました。",
        self::EMAIL_CHANGED_SUCCESS     => "E-Mailアドレスを変更しました。",
        self::EMAIL_CHANGED_EXPIRED     => "この認証コードの有効期限は切れています。もう一度やり直してください。",

        self::IMPORT_ERROR              => "インポート中にエラーが発生しました。",
        self::IMPORT_VALIDATION_INVALID => "インポートできないデータが含まれています。",
        self::IMPORT_DATA_EXIST         => "このデータは既に存在しています。",
    ];
}
