<?php

namespace App\Core\Repository;

use App\Core\Repository\Contracts\Criterion;
use App\Core\Repository\Contracts\Filterable;
use App\Core\Repository\Contracts\Repository;
use App\Exceptions\CriterionException;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RequestCriterion implements Criterion
{
    /**
     * @var Request
     */
    private $request;

    /**
     * RequestCriterion constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * @param Builder $builder
     * @param Repository $repository
     *
     * @return Builder|mixed
     * @throws CriterionException
     */
    public function apply(Builder $builder, Repository $repository)
    {
        return $this->setSearch($builder, $repository);
    }

    /**
     * @param Builder $builder
     * @param Repository $repository
     *
     * @return Builder
     * @throws CriterionException
     */
    protected function setSearch(Builder $builder, Repository $repository)
    {
        foreach ($this->filters() as $filter => $value) {

            if (!$value && !in_array($filter, $repository->getSearchableFields())) {
                continue;
            }

            $object = $this->createFilterClass($repository, $filter);

            if (!$this->isValidObject($object)) {
                throw new CriterionException(sprintf(
                    'Class \'%s\' must be an instance of %s',
                    $object,
                    Filterable::class
                ));
            }

            /** @var Filterable $object */
            $object::apply($builder, $value);
        }

        return $builder;
    }

    /**
     * @return array
     */
    public function filters(): array
    {
        return $this->request->all();
    }

    /**
     * @param Repository $repository
     * @return string
     */
    protected function getNameSpace(Repository $repository): string
    {
        return (new \ReflectionObject($repository))->getNamespaceName();
    }

    /**
     * @param Repository $repository
     * @param string $name
     *
     * @return string
     */
    private function createFilterClass(Repository $repository, string $name): string
    {
        return $this->getNameSpace($repository) . "\\Filters\\" . Str::studly($name);
    }

    /**
     * @param string $class
     *
     * @return bool
     */
    private function isValidObject(string $class): bool
    {
        return class_exists($class) && new $class instanceof Filterable;
    }
}
