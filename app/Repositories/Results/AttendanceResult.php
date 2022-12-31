<?php

namespace App\Repositories\Results;

use App\Repositories\Results\JsonResult;
use App\Models\Attendance;

class AttendanceResult extends JsonResult
{
    public $id;
    public $userId;
    public $relation;
    public $type;
    public $datetime;

    public function __construct(Attendance $entity)
    {
        $this->id       = $entity->id;
        $this->userId   = $entity->user_id;
        $this->relation = $entity->relation;
        $this->type     = $entity->type;
        $this->datetime = $entity->datetime;
    }
}
