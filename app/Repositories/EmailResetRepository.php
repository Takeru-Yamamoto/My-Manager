<?php

namespace App\Repositories;

use App\Repositories\BaseRepository;
use App\Models\EmailReset;
use App\Repositories\Results\EmailResetResult;

class EmailResetRepository extends BaseRepository
{
    protected function model(): EmailReset
    {
        return new EmailReset();
    }

    public function toResult(object $entity): EmailResetResult
    {
        if ($entity instanceof EmailReset) return new EmailResetResult($entity);
    }

    public function createEntity(
        int $userId,
        int $authenticationCode,
        string $newEmail,
        string $expirationDate
    ): EmailReset {
        $entity = new EmailReset();

		$entity->user_id             = $userId;
		$entity->authentication_code = $authenticationCode;
		$entity->new_email           = $newEmail;
		$entity->expiration_date     = $expirationDate;

        return $entity;
    }
}
