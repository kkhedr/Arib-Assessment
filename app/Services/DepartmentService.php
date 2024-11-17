<?php
namespace App\Services;

use Illuminate\Http\Request;
use App\Repositoies\Department\DepartmentInterface;
use App\Filter\Elements\Department\DepartmentFilters;


class DepartmentService{
    private DepartmentInterface $department;
   

    public function __construct(DepartmentInterface $department){
        $this->department = $department;
    }

    public function index($request, DepartmentFilters $filters){
        return $this->department->index($request, $filters);
    }

    public function edit($id){
        return $this->department->find($id);
    }

    public function create($data){
        return $this->department->create($data);
    }
  
    public function update($data, $id){
        return $this->department->update($data, $id);
    }

    public function destroy($id){
    return $this->department->destroy($id);
    }

}