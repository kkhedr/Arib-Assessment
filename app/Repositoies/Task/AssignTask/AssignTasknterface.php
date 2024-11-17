<?php

namespace App\Repositoies\Task\AssignTask;

use App\Filter\Elements\Task\TaskFilters;

interface AssignTasknterface{
    public function assgin($data);
    public function tasks(TaskFilters $filters);
    public function updateStatus($data, $id);
}