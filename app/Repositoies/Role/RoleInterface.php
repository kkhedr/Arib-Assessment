<?php

namespace App\Repositoies\Role;
use App\Models\User;

interface RoleInterface{
    public function get();
    public function addRole(User $user, $type);
    public function syncRole(User $user, $type);
}