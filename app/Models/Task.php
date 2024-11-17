<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = ['id', 'desc', 'createdBy'];

    public function tasks(){
        return $this->hasMany(AssignTask::class, 'task_id', 'id');
    }

    public function manager(){
        return $this->belongdTo(User::class, 'createdBy', 'id');
    }
}
