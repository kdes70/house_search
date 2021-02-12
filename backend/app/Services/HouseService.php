<?php

namespace App\Services;

use App\Models\House\Repository\HouseRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * Class HouseService
 */
class HouseService
{
    /**
     * @var HouseRepository
     */
    private $repository;

    /**
     * HouseService constructor.
     * @param HouseRepository $repository
     */
    public function __construct(HouseRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return LengthAwarePaginator
     */
    public function getBySearch(): LengthAwarePaginator
    {
        return $this->repository->paginate();
    }

    /**
     * @return array
     */
    public function getFiltersParams(): array
    {
        $model = $this->repository->getModel();

        $maxPrice = $model->max('price');
        $minPrice = $model->min('price');

        $bedrooms = $model->distinct('bedrooms')->pluck('bedrooms');
        $bathrooms = $model->distinct('bathrooms')->pluck('bathrooms');
        $storeys = $model->distinct('storeys')->pluck('storeys');
        $garages = $model->distinct('garages')->pluck('garages');

        return [
            'maxPrice'  => $maxPrice,
            'minPrice'  => $minPrice,
            'bedrooms'  => $bedrooms,
            'bathrooms' => $bathrooms,
            'storeys'   => $storeys,
            'garages'   => $garages,
        ];
    }

}
