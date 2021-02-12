<?php

namespace App\Core\Repository\Contracts;

use App\Core\Eloquent\AbstractModel;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * Interface Repository
 */
interface Repository
{
    /**
     * «Чистая» модель.
     *
     * @return AbstractModel
     */
    public function getModel();

    /**
     * Запрос с критериями, связями, сортировкой, фильтрами и прочим.
     *
     * @return Builder
     */
    public function getQuery(): Builder;

    /**
     * @param int $value
     *
     * @return static
     */
    public function setPerPage(int $value = 10);

    /**
     * Пагинация запроса.
     *
     * @param Model|Builder|null $query
     *
     * @return LengthAwarePaginator
     */
    public function paginate($query = null): LengthAwarePaginator;

    /**
     * Поля по которым разрешен поиск
     *
     * @return array
     */
    public function getSearchableFields(): array;

    /**
     * Включить/выключить применение критериев к запросу.
     *
     * @param bool $skip
     *
     * @return static
     */
    public function skipCriteria(bool $skip = true);

    /**
     * Сброс всех критериев.
     *
     * @return $this
     */
    public function resetCriteria();

    /**
     * Добавление критерия.
     *
     * @param Criterion|string $criterion
     *
     * @return $this
     */
    public function pushCriterion($criterion);

    /**
     * Удаление критерия.
     *
     * @param Criterion|string $criterion
     *
     * @return $this
     */
    public function pullCriterion($criterion);
}
