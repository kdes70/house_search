<?php

namespace App\Core\Repository\Contracts;

use Illuminate\Database\Eloquent\Builder;

/**
 * Interface Criterion
 */
interface Criterion
{
    /**
     * @param Builder $builder
     * @param Repository $repository
     *
     * @return mixed
     */
    public function apply(Builder $builder, Repository $repository);
}
