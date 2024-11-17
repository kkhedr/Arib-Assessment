<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Task\TaskRequest;
use App\Services\TaskService;

class TaskController extends Controller
{
    private TaskService $service;

    public function __construct(TaskService $service){
        $this->service = $service;
    }

    public function index(Request $request){
       $tasks = $this->service->index($request->all());
       return view('dashboard.task.index', compact('tasks'));
    }

    public function create(){
        return view('dashboard.task.create');
    }

    public function edit($id){
        $task = $this->service->edit($id);
        return view('dashboard.task.edit', compact('task'));
    }

    public function store(TaskRequest $request){
        $this->service->create($request->validated());
        return redirect('/tasks')->with(['success' => __('messages.created')]);
    }

    public function update(TaskRequest $request, $id){
        $this->service->update($request->validated(), $id);
        return redirect('/tasks')->with(['success' => __('messages.updated')]);
    }

    public function destroy($id){
        $this->service->destroy($id);
        return redirect('/tasks')->with(['success' => __('messages.deleted')]);
    }
}
