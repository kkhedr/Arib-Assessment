<?php
namespace App\Filter\Elements\Task;

use App\Filter\Filters;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;


class TaskFilters extends Filters 
{    
    /**
     * search_name
     *
     * @param  array $value
     * @return Builder
     */
    public function search(string $value): Builder
    {
        $builder = $this->builder->whereHas('task', function($q) use($value){
            $q->where('desc', 'LIKE', '%'.$value.'%');
        });

        return $builder;
    }

}
