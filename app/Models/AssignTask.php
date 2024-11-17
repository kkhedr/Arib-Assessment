<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Filter\Filterable;


class AssignTask extends Model
{
    use Filterable;
    
    protected $fillable = ['id', 'employee_id', 'task_id', 'createdBy', 'status'];

    public function task(){
        return $this->belongsTo(Task::class, 'task_id', 'id');
    }

    public function employee(){
        return $this->belongsTo(User::class, 'employee_id', 'id');
    }

    public function manager(){
        return $this->belongsTo(User::class, 'createdBy', 'id');
    }
}
