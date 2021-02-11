<?php

namespace App\Core\Repository\Contracts;

use Illuminate\Database\Eloquent\Builder;

/**
 * Interface Filterable
 */
interface Filterable
{
    /**
     * @param Builder $builder
     * @param $value
     *
     * @return Builder
     */
    public static function apply(Builder $builder, $value): Builder;
}
