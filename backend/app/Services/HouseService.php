<?php

namespace App\Services;

use App\Models\House\House;
use App\Models\House\Repository\HouseRepository;

/**
 * Class HouseService
 */
class HouseService
{
    /**
     * @var HouseRepository
     */
    private $repository;

    public function __construct(HouseRepository $repository)
    {
        $this->repository = $repository;
    }


    public function getBySearch()
    {
        return $this->repository->getQuery()->paginate(10);
    }

}
