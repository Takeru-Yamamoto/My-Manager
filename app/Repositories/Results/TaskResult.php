<?php

namespace App\Repositories\Results;

use App\Repositories\Results\JsonResult;
use App\Models\Task;

class TaskResult extends JsonResult
{
    public $id;
    public $userId;
    public $title;
    public $comment;
    public $taskColorId;
    public $startDate;
    public $endDate;

    public $taskColor;

    public function __construct(Task $entity)
    {
        $this->id          = $entity->id;
        $this->userId      = $entity->user_id;
        $this->title       = $entity->title;
        $this->comment     = $entity->comment;
        $this->taskColorId = $entity->task_color_id;
        $this->startDate   = $entity->start_date;
        $this->endDate     = $entity->end_date;

        $this->taskColor   = $entity->taskColor;
    }
}
