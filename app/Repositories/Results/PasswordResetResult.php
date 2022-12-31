<?php

namespace App\Repositories\Results;

use App\Repositories\Results\JsonResult;
use App\Models\PasswordReset;

class PasswordResetResult extends JsonResult
{
    public $id;
    public $email;
    public $token;
    public $expirationDate;
    public $createdAt;

    public function __construct(PasswordReset $entity)
    {
        $this->email          = $entity->email;
        $this->token          = $entity->token;
        $this->expirationDate = $entity->expiration_date;
        $this->createdAt      = $entity->created_at;
    }
}
