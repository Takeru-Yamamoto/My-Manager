<?php

namespace App\Repositories;

use App\Repositories\BaseRepository;
use App\Models\TaskColor;
use App\Repositories\Results\TaskColorResult;

class TaskColorRepository extends BaseRepository
{
    protected function model(): TaskColor
    {
        return new TaskColor();
    }

    public function toResult(object $entity): TaskColorResult
    {
        if ($entity instanceof TaskColor) {
            return new TaskColorResult($entity);
        }
    }

    public function createEntity(
        string $color,
        string $description,
    ): TaskColor {
        $entity = new TaskColor();

        $entity->color       = $color;
        $entity->description = $description;

        return $entity;
    }
}
