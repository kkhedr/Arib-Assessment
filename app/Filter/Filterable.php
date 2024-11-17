<?php

namespace App\Filter;

use Illuminate\Contracts\Database\Eloquent\Builder;

trait Filterable
{

    /**
     * scopeFilter
     *
     * @param  Builder $query
     * @param  Filters $filters
     * @return mixed
     */
    public function scopeFilter(Builder $query, Filters $filters)
    {
        return $filters->apply($query);
    }
}

