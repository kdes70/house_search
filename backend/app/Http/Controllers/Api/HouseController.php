<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\HouseResource;
use App\Services\HouseService;
use Illuminate\Http\Request;

/**
 * Class HouseController
 */
class HouseController extends Controller
{
    /**
     * @var HouseService
     */
    private $service;

    /**
     * @param HouseService $service
     */
    public function __construct(HouseService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $houses = $this->service->getBySearch();

        return HouseResource::collection($houses);
    }
}
