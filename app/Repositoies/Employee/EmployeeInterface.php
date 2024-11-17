<?php

namespace App\Repositoies\Employee;

use App\Filter\Elements\User\UserFilters;

interface EmployeeInterface{

    public function index(array $request, UserFilters $filters);
    public function create(array $data);
    public function update(array $data, $id);
    public function destroy($id);
}