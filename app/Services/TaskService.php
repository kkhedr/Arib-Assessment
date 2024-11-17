<?php
namespace App\Services;

use Illuminate\Http\Request;
use App\Repositoies\Task\TaskInterface;


class TaskService{
    private TaskInterface $task;
   

    public function __construct(TaskInterface $task){
        $this->task = $task;
    }

    public function index($request){
        return $this->task->index($request);
    }

    public function edit($id){
        return $this->task->find($id);
    }

    public function create($data){
        return $this->task->create($data);
    }
  
    public function update($data, $id){
        return $this->task->update($data, $id);
    }

    public function destroy($id){
    return $this->task->destroy($id);
    }

}