<?php

namespace App\Models\House\Repository\Filters;

use App\Core\Repository\Contracts\Filterable;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class Name
 */
class Name implements Filterable
{
    /**
     * @param Builder $builder
     * @param $value
     *
     * @return Builder
     */
    public static function apply(Builder $builder, $value): Builder
    {
        return $builder->where('name', 'like', "%$value%");
    }
}
