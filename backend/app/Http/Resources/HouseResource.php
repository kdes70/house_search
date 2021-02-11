<?php

namespace App\Http\Resources;

use App\Models\House\House;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class HouseResource
 */
class HouseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return  array|null
     */
    public function toArray($request): ?array
    {
        $model = $this->resource;

        if (empty($model) || !($model instanceof House)) {
            return null;
        }

        return [
            'id'        => $model->id,
            'name'      => $model->name,
            'price'     => $model->price,
            'bedrooms'  => $model->bedrooms,
            'bathrooms' => $model->bathrooms,
            'storeys'   => $model->storeys,
            'garages'   => $model->garages,
        ];
    }
}
