<?php
namespace App\Filter\Elements\User;

use App\Filter\Filters;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;


class UserFilters extends Filters 
{    
    /**
     * search_name
     *
     * @param  array $value
     * @return Builder
     */
    public function search(string $value): Builder
    {
        $builder =  $this->builder->where(function($q) use($value){
            $q->where('first_name', 'LIKE', '%'.$value.'%')
                ->orWhere('last_name', 'LIKE', '%'.$value.'%')
                ->orWhere('email', 'LIKE', '%'.$value.'%');
        });
        if(Auth::user()->hasRole('manager')){
            $builder = $builder->where('manager_id', Auth::user()->id);
        }

        return $builder;
    }

}
