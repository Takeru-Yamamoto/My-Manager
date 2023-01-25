<?php

namespace App\Repositories;

use App\Repositories\BaseRepository;
use App\Models\PasswordReset;
use App\Repositories\Results\PasswordResetResult;

class PasswordResetRepository extends BaseRepository
{
    protected function model(): PasswordReset
    {
        return new PasswordReset();
    }

    public function toResult(object $entity): PasswordResetResult
    {
        if ($entity instanceof PasswordReset) return new PasswordResetResult($entity);
    }

    public function createEntity(
        string $email,
        string $token,
        string $expiration_date
    ): PasswordReset {
        $entity = new PasswordReset();

        $entity->email           = $email;
        $entity->token           = $token;
        $entity->expiration_date = $expiration_date;

        return $entity;
    }
}
