<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\EmployeeService;
use App\Filter\Elements\User\UserFilters;
use App\Http\Requests\Employee\EmployeeRequest;

class EmployeeController extends Controller
{
    private EmployeeService $service;

    public function __construct(EmployeeService $service){
        $this->service = $service;
    }

    public function index(Request $request, UserFilters $filters){
        $employees = $this->service->index($request, $filters);
        return view('dashboard.employee.index', compact('employees'));
    }

    public function getManagersByDepartment($id){
        return $this->service->getManagersByDepartment($id);
    }

    public function edit($id){
        $data = $this->service->edit($id);
        $managers = $data[1];
        $departments = $data[2];
        $permissions = $data[3];
        $employee = $data[0];
        return view('dashboard.employee.edit', compact('managers', 'departments', 'permissions', 'employee'));
    }

    public function create(){
        $data = $this->service->create();
        $managers = $data[0];
        $departments = $data[1];
        $permissions = $data[2];

        return view('dashboard.employee.create', compact('managers', 'departments', 'permissions'));
    }

    public function store(EmployeeRequest $request){
        $this->service->store($request);
        return redirect('/employees')->with(['success' => __('messages.created')]);
    }

    public function update($id, EmployeeRequest $request){
        $this->service->update($id, $request);
        return redirect('/employees')->with(['success' => __('messages.updated')]);
    }

    public function destroy($id){
        $this->service->destroy($id);
        return redirect('/employees')->with(['success' => __('messages.deleted')]);
    }
    
}
