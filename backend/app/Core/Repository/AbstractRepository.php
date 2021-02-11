<?php

namespace App\Core\Repository;

use App\Core\Repository\Contracts\Criterion;
use App\Core\Repository\Contracts\Repository;
use App\Exceptions\RepositoryException;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

/**
 * Class AbstractRepository
 */
abstract class AbstractRepository implements Repository
{
    /**
     * @var array
     */
    protected $fieldsSearchable = [];

    /**
     * @var Collection
     */
    protected $criteria;

    /**
     * @var bool
     */
    protected $skipCriteria = false;

    /**
     * AbstractRepository constructor.
     */
    public function __construct()
    {
        $this->resetCriteria();
        $this->boot();
    }

    /**
     * @throws RepositoryException
     */
    protected function boot(): void
    {
        $this->pushCriterion(RequestCriterion::class);
    }

    /**
     * {@inheritdoc}
     */
    abstract public function getModel();

    /**
     * @return Builder
     */
    public function getQuery(): Builder
    {
        return $this->applyCriteria($this->getModel()->query());
    }

    /**
     * Поля по которым разрешен поиск
     */
    public function getSearchableFields(): array
    {
        return $this->fieldsSearchable;
    }

    /**
     * @return Collection
     */
    public function getCriteria(): Collection
    {
        return $this->criteria;
    }

    /**
     * @param bool $skip
     *
     * @return $this|AbstractRepository
     */
    public function skipCriteria(bool $skip = true)
    {
        $this->skipCriteria = $skip;

        return $this;
    }

    /**
     * @return $this|AbstractRepository
     */
    public function resetCriteria()
    {
        $this->criteria = collect();

        return $this;
    }

    /**
     * @param Criterion|string $criterion
     *
     * @return $this|AbstractRepository
     *
     * @throws RepositoryException
     */
    public function pushCriterion($criterion)
    {
        if (is_string($criterion)) {
            $criterion = app($criterion);
        }

        $class = get_class($criterion);

        if (!$criterion instanceof Criterion) {
            throw new RepositoryException(sprintf('Class \'%s\' must be an instance of %s', $class, Criterion::class));
        }

        $this->criteria->put($class, $criterion);

        return $this;
    }

    /**
     * @param Criterion|string $criterion
     *
     * @return $this|AbstractRepository
     */
    public function pullCriterion($criterion)
    {
        if (is_object($criterion)) {
            $criterion = get_class($criterion);
        }

        $this->criteria->pull($criterion);

        return $this;
    }

    /**
     * Применение критериев.
     *
     * @param Builder $model
     * @return Builder
     */
    protected function applyCriteria(Builder $model)
    {
        if ($this->skipCriteria) {
            return $model;
        }

        foreach ($this->getCriteria() as $criterion) {
            $model = $criterion->apply($model, $this);
        }

        return $model;
    }

}
