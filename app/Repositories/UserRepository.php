<?php

namespace App\Repositories;

use App\Repositories\BaseRepository;
use App\Models\User;
use App\Repositories\Results\UserResult;

class UserRepository extends BaseRepository
{
    protected function model(): User
    {
        return new User();
    }

    public function toResult(object $entity): UserResult
    {
        if ($entity instanceof User) {
            return new UserResult($entity);
        }
    }

    public function createEntity(
        string $name,
        string $email,
        string $password,
        int $role
    ): User {
        $entity = new User();

        $entity->name     = $name;
        $entity->email    = $email;
        $entity->password = $password;
        $entity->role     = $role;

        return $entity;
    }
}
