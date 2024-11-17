<?php

namespace App\Repositoies\Role;

use App\Models\Role;
use App\Models\User;

class RoleRepository implements RoleInterface{

    private Role $role;
    public function __construct(Role $role){
        $this->role = $role;
    }

    public function get(){
        return $this->role->get();
    }

    public function addRole(User $user, $type='employee'){
        $role = $this->role->where('name', $type)->first();
        $user->addRole($role);
    }


    public function syncRole(User $user, $type='employee'){
        $role = $this->role->where('name', $type)->first();
        $user->syncRoles([$role]);
    }
}