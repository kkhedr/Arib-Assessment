<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AssignTaskService;
use App\Http\Requests\AssignTask\AssignTaskRequest;
use App\Filter\Elements\Task\TaskFilters;


class AssignTaskController extends Controller
{
    private AssignTaskService $service;

    public function __construct(AssignTaskService $service){
        $this->service = $service;
    }

    public function create(){
        $user = auth()->user();
        $tasks = $this->service->assignTaskForEmployee($user->id);
        $employees = $user->employees;
        return view('dashboard.assigntask.create', compact('tasks', 'employees'));
    }

    public function store(AssignTaskRequest $request){
        $this->service->assgin($request->validated());
        return redirect('/assign-tasks')->with(['success' => __('messages.created')]); 
    }

    public function update(AssignTaskRequest $request, $id){
        $this->service->updateStatus($request->validated(), $id);
        return redirect('/assign-tasks')->with(['success' => __('messages.updated')]); 
    }

    public function index(TaskFilters $filters){
        $data = $this->service->tasks($filters);
        return view('dashboard.assigntask.index', compact('data'));
    }

}
