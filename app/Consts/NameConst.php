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
        'access'                 => 'アクセス',
        'additional'             => '追加項目',
        'address'                => '住所',
        'authentication_code'    => '認証コード',
        'color'                  => '色',
        'comment'                => 'コメント',
        'description'            => '説明',
        'email'                  => 'メールアドレス',
        'end_date'               => '終了日',
        'facebook_id'            => 'Facebook ID',
        'flg'                    => 'フラグ',
        'id'                     => 'ID',
        'instagram_id'           => 'Instagram ID',
        'is_valid'               => '有効フラグ',
        'limit'                  => 'リミット',
        'line_id'                => 'LINE ID',
        'month'                  => '対象月',
        'name'                   => '名',
        'page'                   => 'ページ',
        'password_confirmation'  => 'パスワード(確認用)',
        'password'               => 'パスワード',
        'post_code'              => '郵便番号',
        'prefecture'             => '都道府県',
        'relation'               => '関係性',
        'role'                   => '役割',
        'start_date'             => '開始日',
        'status'                 => 'ステータス',
        'tel'                    => '電話番号',
        'title'                  => 'タイトル',
        'token'                  => 'トークン',
        'twitter_id'             => 'Twitter ID',
        'type'                   => 'タイプ',
        'user_id'                => '対象ユーザー',
        'youtube_id'             => 'Youtube ID',

        /* unique */
        'task_color_id'          => 'タスクカラー',
    ];
}
