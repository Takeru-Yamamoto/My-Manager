<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use HasFactory, BaseModel, SoftDeletes;

    public function taskColor()
    {
        return $this->belongsTo(TaskColor::class);
    }
}
