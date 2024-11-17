<?php

namespace App\Repositoies\Permission;

use App\Models\Permission;

class PermissionRepository implements PermissionInterface{

    private Permission $permission;
    public function __construct(Permission $permission){
        $this->permission = $permission;
    }

    public function get(){
        return $this->permission->get();
    }
}