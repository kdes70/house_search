<?php

namespace Tests\Feature;

use App\Models\House\House;
use Tests\TestCase;

class HouseControllerTest extends TestCase
{
    public function testGetListNotCriteria()
    {
        House::factory()->create();

        $this->getJson(route('api.houses'))
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    [
                        'id',
                        'name',
                        'price',
                        'bedrooms',
                        'bathrooms',
                        'storeys',
                        'garages',
                    ]
                ],
                'links',
                'meta'
            ]);
    }

    public function testGetListNameCriteria()
    {
        House::factory([
            'name' => 'Fooo'
        ])->create();

        $res = $this->getJson(route('api.houses', [
            'name' => 'Foo'
        ]))
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    [
                        'id',
                        'name',
                        'price',
                        'bedrooms',
                        'bathrooms',
                        'storeys',
                        'garages',
                    ]
                ],
                'links',
                'meta'
            ]);

        $this->assertEquals($res->json('data')[0]['name'], 'Fooo');
    }

    public function testGetListPriceCriteria()
    {
        House::factory([
            'price' => rand(100, 200)
        ])->create();

        $this->getJson(route('api.houses', [
            'price' => [100, 200]
        ]))
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    [
                        'id',
                        'name',
                        'price',
                        'bedrooms',
                        'bathrooms',
                        'storeys',
                        'garages',
                    ]
                ],
                'links',
                'meta'
            ]);
    }

    public function testGetListBedroomsCriteria()
    {
        House::factory([
            'bedrooms' => 2
        ])->create();

        $res = $this->getJson(route('api.houses', [
            'bedrooms' => 2
        ]))
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    [
                        'id',
                        'name',
                        'price',
                        'bedrooms',
                        'bathrooms',
                        'storeys',
                        'garages',
                    ]
                ],
                'links',
                'meta'
            ]);

        $this->assertEquals($res->json('data')[0]['bedrooms'], 2);
    }

    public function testGetListBathroomsCriteria()
    {
        House::factory([
            'bathrooms' => 2
        ])->create();

        $res = $this->getJson(route('api.houses', [
            'bathrooms' => 2
        ]))
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    [
                        'id',
                        'name',
                        'price',
                        'bedrooms',
                        'bathrooms',
                        'storeys',
                        'garages',
                    ]
                ],
                'links',
                'meta'
            ]);

        $this->assertEquals($res->json('data')[0]['bathrooms'], 2);
    }

    public function testGetListStoreysCriteria()
    {
        House::factory([
            'storeys' => 2
        ])->create();

        $res = $this->getJson(route('api.houses', [
            'storeys' => 2
        ]))
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    [
                        'id',
                        'name',
                        'price',
                        'bedrooms',
                        'bathrooms',
                        'storeys',
                        'garages',
                    ]
                ],
                'links',
                'meta'
            ]);

        $this->assertEquals($res->json('data')[0]['storeys'], 2);
    }

    public function testGetListGaragesCriteria()
    {
        House::factory([
            'garages' => 2
        ])->create();

        $res = $this->getJson(route('api.houses', [
            'garages' => 2
        ]))
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    [
                        'id',
                        'name',
                        'price',
                        'bedrooms',
                        'bathrooms',
                        'storeys',
                        'garages',
                    ]
                ],
                'links',
                'meta'
            ]);

        $this->assertEquals($res->json('data')[0]['garages'], 2);
    }

    public function testGetListAnyCriteria()
    {
        House::factory([
            'garages' => 2,
            'name' => 'Fooo'
        ])->count(2)->create();


        $res = $this->getJson(route('api.houses', [
            'garages' => 2,
            'name' => 'Foo'
        ]))
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    [
                        'id',
                        'name',
                        'price',
                        'bedrooms',
                        'bathrooms',
                        'storeys',
                        'garages',
                    ]
                ],
                'links',
                'meta'
            ]);

        $this->assertEquals(count($res->json('data')), 2);
    }
}
