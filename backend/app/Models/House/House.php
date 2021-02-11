<?php

namespace App\Models\House;

use App\Core\Eloquent\AbstractModel;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class House
 *
 * @property int $id
 * @property string $name
 * @property int $price
 * @property int $bedrooms
 * @property int $bathrooms
 * @property int $storeys
 * @property int $garages
 *
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class House extends AbstractModel
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'bedrooms',
        'bathrooms',
        'storeys',
        'garages',
    ];
}
