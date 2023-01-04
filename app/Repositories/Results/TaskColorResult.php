<?php

namespace App\Repositories\Results;

use App\Repositories\Results\JsonResult;
use App\Models\TaskColor;

class TaskColorResult extends JsonResult
{
    public $id;
    public $color;
    public $description;

    public function __construct(TaskColor $entity)
    {
        $this->id          = $entity->id;
        $this->color       = $entity->color;
        $this->description = $entity->description;
    }
}
