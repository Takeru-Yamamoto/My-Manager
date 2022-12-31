<?php

namespace App\Repositories;

use App\Repositories\BaseRepository;
use App\Models\Attendance;
use App\Repositories\Results\AttendanceResult;

class AttendanceRepository extends BaseRepository
{
    protected function model(): Attendance
    {
        return new Attendance();
    }

    public function toResult(object $entity): AttendanceResult
    {
        if ($entity instanceof Attendance) {
            return new AttendanceResult($entity);
        }
    }

    public function createEntity(
        int $userId,
        ?int $relation,
        string $type,
        string $datetime
    ): Attendance {
        $entity = new Attendance();

        $entity->user_id  = $userId;
        $entity->relation = $relation;
        $entity->type     = $type;
        $entity->datetime = $datetime;

        return $entity;
    }
}
