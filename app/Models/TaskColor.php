<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskColor extends Model
{
    use HasFactory, BaseModel;
 
    public $timestamps = false;

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
