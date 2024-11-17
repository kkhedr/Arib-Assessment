<?php

namespace App\Repositoies\Task;

use App\Models\Task;

class TaskRepository implements TaskInterface{

    private Task $task;
    public function __construct(Task $task){
        $this->task = $task;
    }

    public function index($request){
      return $this->task->paginate(isset($request['per_page']) ? $request['per_page'] : 10);
    }

    public function getTasksByManager($manager_id){
        return $this->task->where('createdBy', $manager_id)->get();
    }

    public function find($id){
        return $this->task->find($id);
    }

    public function create($data){
        $data['createdBy'] = auth()->user()->id;
        return $this->task->create($data);
    }

    public function update($data, $id){
        $task = $this->task->findOrFail($id);
        if(!$task){
            return null;
        }
        return $task->update($data);
    }

    public function destroy($id){
        $task = $this->task->find($id);
        if(!$task){
            return null;
        }
        $task->delete();
    }
}