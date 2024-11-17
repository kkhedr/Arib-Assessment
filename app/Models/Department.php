<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Filter\Filterable;


class Department extends Model
{
    use Filterable;
    
    protected $fillable = ['id', 'name'];

    public function employees(){
        return $this->hasMany(User::class, 'department_id', 'id');
    }

}
