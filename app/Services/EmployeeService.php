<?php
namespace App\Services;

use App\Repositoies\Employee\EmployeeInterface;
use App\Http\Requests\Employee\EmployeeRequest;
use App\Repositoies\Department\DepartmentInterface;
use App\Repositoies\Permission\PermissionInterface;
use App\Repositoies\Role\RoleInterface;
use Illuminate\Http\Request;
use App\Filter\Elements\User\UserFilters;

class EmployeeService{
    private EmployeeInterface $employee;
    private DepartmentInterface $department;
    private PermissionInterface $permission;
    private RoleInterface $role;

    public function __construct(EmployeeInterface $employee, DepartmentInterface $department, PermissionInterface $permission, RoleInterface $role){
        $this->employee = $employee;
        $this->department = $department;
        $this->permission = $permission;
        $this->role = $role;
    }

    public function index(Request $request, UserFilters $filters){
        return $this->employee->index($request->all(), $filters);
    }

    public function edit($id){
        $employee = $this->employee->find($id);
        $managers = $this->employee->managers($id);
        $departments =  $this->department->get();
        $permissions =  $this->permission->get();
        return [$employee, $managers, $departments, $permissions];
    }

    public function getManagersByDepartment($department_id){
        return $this->employee->getManagersByDepartment($department_id);
    }

    public function create(){
        $managers = $this->employee->managers();
        $departments =  $this->department->get();
        $permissions =  $this->permission->get();
        return [$managers, $departments, $permissions];
    }

    public function store(EmployeeRequest $request){
        $data = isset($request->permissions) ? collect($request->all())->except('permissions')->toArray() : $request->validated();
        
        $is_employee = $data['is_employee']; 
        unset($data['is_employee']);
        $employee = $this->employee->create($data);
        $is_employee == 1 ? $this->role->addRole($employee, 'employee') : $this->role->addRole($employee, 'manager');
        isset($request->permissions) && $request->permissions != null? $employee->permissions()->attach($request->permissions): '';
    }

    public function update($id, EmployeeRequest $request){
        $data = isset($request->permissions) ? collect($request->all())->except('permissions')->toArray() : $request->validated();
        $is_employee = null;
        if(isset($data['is_employee'])){
            $is_employee = $data['is_employee'];
            unset($data['is_employee']);
        }
        $employee = $this->employee->update($data, $id);
        if($is_employee != null){
            $is_employee == 1 ? 
            $this->role->syncRole($employee, 'employee') :
            $this->role->syncRole($employee, 'manager');
        }
        isset($request->permissions) && $request->permissions != null ? $employee->syncPermissions($request->permissions): '';        
    }

    public function destroy($id){
        $this->employee->destroy($id);
    }
}