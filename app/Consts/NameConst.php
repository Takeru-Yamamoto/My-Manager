<?php

namespace App\Consts;

class NameConst
{
    public const CREATE = "create";
    public const UPDATE = "update";
    public const DELETE = "delete";
    public const CHANGE = "change";
    public const TRUE   = 1;
    public const FALSE  = 0;

    public const TYPE_FULL   = "full";
    public const TYPE_SHORT  = "short";

    public const TYPES = [
        self::TYPE_FULL,
        self::TYPE_SHORT,
    ];

    public const NAMES = [
        self::TYPES[0] => [
            self::CREATE => "新規登録",
            self::UPDATE => "編集",
            self::DELETE => "完全削除",
            self::CHANGE => "変更",
            self::TRUE   => "有効",
            self::FALSE  => "無効",
        ],
        self::TYPES[1] => [
            self::CREATE => "登録",
            self::UPDATE => "編集",
            self::DELETE => "削除",
            self::CHANGE => "変更",
            self::TRUE   => "有効",
            self::FALSE  => "無効",
        ],
    ];

    public const FORM_ATTRIBUTES = [
        'name' => 'アカウント名',
        'email' => 'メールアドレス',
        'status'=>'ステータス',
        'password' => 'パスワード',
        'password_confirmation'=>'パスワード(確認用)',
    ];
}
