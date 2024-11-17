<?php

namespace App\Repositoies\Task\AssignTask;

use App\Models\AssignTask;
use App\Filter\Elements\Task\TaskFilters;

class AssignTaskRepository implements AssignTasknterface{

    private AssignTask $task;

    public function __construct(AssignTask $task){
        $this->task = $task;
    }

    public function assgin($data){
        $data['createdBy'] = auth()->user()->id;
        return $this->task->create($data);
    }


    public function updateStatus($data, $id){
        $task = $this->task->find($id);
        if($task){
            return $this->task->update($task);
        }
        return null;
    }

    public function tasks(TaskFilters $filters){
        $user = auth()->user();
        if($user->hasRole('manager')){
            return $this->task->with(['task', 'employee', 'manager'])->filter($filters)->where('createdBy', $user->id)->paginate(request()->per_page ? request()->per_page : 10);

        }elseif($user->hasRole('employee')){
            return $this->task->with(['task', 'employee', 'manager'])->filter($filters)->where('employee_id', $user->id)->paginate(request()->per_page ? request()->per_page : 10);

        }else{
            return [];
        }
    }
}