<?php
namespace App\Services;

use Illuminate\Http\Request;
use App\Repositoies\Task\AssignTask\AssignTasknterface;
use App\Filter\Elements\Task\TaskFilters;
use App\Repositoies\Task\TaskInterface;

class AssignTaskService{
    private AssignTasknterface $task;
    private TaskInterface $tasksManager;
    public function __construct(AssignTasknterface $task, TaskInterface $tasksManager){
        $this->task = $task;
        $this->tasksManager = $tasksManager;
    }

    public function assignTaskForEmployee($manager_id){
        return $this->tasksManager->getTasksByManager($manager_id);
    }

    public function assgin($data){
        return $this->task->assgin($data);
    }

    public function tasks(TaskFilters $filters){
        return $this->task->tasks($filters);
    }

    public function updateStatus($data, $id){
        return $this->task->updateStatus($data, $id);
    }

}