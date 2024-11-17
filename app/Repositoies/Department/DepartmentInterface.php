<?php

namespace App\Repositoies\Department;

use App\Filter\Elements\Department\DepartmentFilters;

interface DepartmentInterface{

    public function index($request, DepartmentFilters $filters);
    public function create($data);
    public function update($data, $id);
    public function destroy($id);
    public function get();
}