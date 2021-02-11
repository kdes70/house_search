<?php

namespace App\Models\House\Repository;

use App\Core\Eloquent\AbstractModel;
use App\Core\Repository\AbstractRepository;
use App\Models\House\House;

/**
 * Class HouseRepository
 */
class HouseRepository extends AbstractRepository
{
    /**
     * @var string[]
     */
    protected $fieldsSearchable = [
        'name',
        'price',
        'bedrooms',
        'bathrooms',
        'storeys',
        'garages',
    ];

    /**
     * @return AbstractModel|House
     */
    public function getModel(): House
    {
        return new House();
    }
}
