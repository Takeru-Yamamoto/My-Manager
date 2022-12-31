<?php

namespace App\Repositories;

use App\Repositories\BaseRepository;
use App\Models\Profile;
use App\Repositories\Results\ProfileResult;

class ProfileRepository extends BaseRepository
{
    protected function model(): Profile
    {
        return new Profile();
    }

    public function toResult(object $entity): ProfileResult
    {
        if ($entity instanceof Profile) return new ProfileResult($entity);
    }

    public function createEntity(
        int $createdBy,
    ): Profile {
        $entity = new Profile();

		$entity->created_by = $createdBy;

        return $entity;
    }
}
