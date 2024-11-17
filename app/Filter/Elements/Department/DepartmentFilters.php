<?php
namespace App\Filter\Elements\Department;

use App\Filter\Filters;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;


class DepartmentFilters extends Filters 
{    
    /**
     * search_name
     *
     * @param  array $value
     * @return Builder
     */
    public function search(string $value): Builder
    {
        return $this->builder->where('name', 'LIKE', '%'.$value.'%');
    }

}
