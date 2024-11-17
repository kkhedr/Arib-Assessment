<?php

namespace App\Repositoies\Department;

use App\Models\Department;
use App\Filter\Elements\Department\DepartmentFilters;


class DepartmentRepository implements DepartmentInterface{

    private Department $department;
    public function __construct(Department $department){
        $this->department = $department;
    }

    public function index($request, DepartmentFilters $filters){
      return $this->department->withCount('employees')->withSum('employees', 'salary')->filter($filters)->paginate(isset($request['per_page']) ? $request['per_page'] : 10);
    }

    public function get(){
        return $this->department->get();
    }

    public function find($id){
        return $this->department->find($id);
    }

    public function create($data){
        return $this->department->create($data);
    }

    public function update($data, $id){
        $department = $this->department->findOrFail($id);
        if(!$department){
            return null;
        }
        return $department->update($data);
    }

    public function destroy($id){
        $department = $this->department->find($id);
        if(!$department){
            return null;
        }
        $department->delete();
    }
}