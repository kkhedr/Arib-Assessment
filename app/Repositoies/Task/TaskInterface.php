<?php

namespace App\Repositoies\Task;


interface TaskInterface{

    public function index($request);
    public function create($data);
    public function update($data, $id);
    public function destroy($id);
    public function getTasksByManager($manager_id);
}