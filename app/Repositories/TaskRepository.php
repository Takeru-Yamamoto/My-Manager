<?php

namespace App\Repositories;

use App\Repositories\BaseRepository;
use App\Models\Task;
use App\Repositories\Results\TaskResult;

class TaskRepository extends BaseRepository
{
    protected function model(): Task
    {
        return new Task();
    }

    public function toResult(object $entity): TaskResult
    {
        if ($entity instanceof Task) {
            return new TaskResult($entity);
        }
    }

    public function createEntity(
        int $userId,
        string $title,
        ?string $comment,
        string $startDate,
        string $endDate
    ): Task {
        $entity = new Task();

        $entity->user_id    = $userId;
        $entity->title      = $title;
        $entity->comment    = $comment;
        $entity->start_date = $startDate;
        $entity->end_date   = $endDate;

        return $entity;
    }
}
