<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Department\DepartmentRequest;
use App\Repositoies\Department\DepartmentInterface;
use App\Services\DepartmentService;
use App\Filter\Elements\Department\DepartmentFilters;

class DepartmentController extends Controller
{
    private DepartmentService $service;

    public function __construct(DepartmentService $service){
        $this->service = $service;
    }

    public function index(Request $request, DepartmentFilters $filters){
       $departments = $this->service->index($request->all(), $filters);
       return view('dashboard.department.index', compact('departments'));
    }

    public function create(){
        return view('dashboard.department.create');
    }

    public function edit($id){
        $department = $this->service->edit($id);
        return view('dashboard.department.edit', compact('department'));
    }

    public function store(DepartmentRequest $request){
        $this->service->create($request->validated());
        return redirect('/departments')->with(['success' => __('messages.created')]);
    }

    public function update(DepartmentRequest $request, $id){
        $this->service->update($request->validated(),$id);
        return redirect('/departments')->with(['success' => __('messages.updated')]);
    }

    public function destroy($id){
        $this->service->destroy($id);
        return redirect('/departments')->with(['success' =>  __('messages.deleted')]);
    }
}
