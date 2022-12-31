<?php

namespace App\Repositories\Results;

use App\Repositories\Results\JsonResult;
use App\Models\Profile;

class ProfileResult extends JsonResult
{
    public $id;
    public $createdBy;
    public $createdAt;
    public $updatedAt;

    public function __construct(Profile $entity)
    {
        $this->id        = $entity->id;
        $this->createdBy = $entity->created_by;
        $this->createdAt = $entity->created_at;
        $this->updatedAt = $entity->updated_at;
    }
}
