<?php

namespace App\Services;

use App\Kernel;
use App\Models\Banner;
use App\Models\Ingredient;
use App\Models\Kitchen;
use Exception;
use Illuminate\Database\Eloquent\Builder;

class IngredientService extends ModelService
{

    /**
     * storable field is a field which can be filled during creating the record
     */
    protected array $storables = [
        'title',
        'photo_id', 'description','delivery_fee'
    ];

    /**
     * updatable field is a field which can be filled during updating the record
     */
    protected array $updatables = [
        'title',
        'photo_id', 'description'
    ];

    /**
     * searchable field is a field which can be searched for from keyword parameter in search method
     */
    protected array $searchables = ['title',];
    /**
     *
     */
    protected array $with = ["food"];

    public function builder(): Builder
    {
        return Ingredient::query();
    }

    /**
     * prepare
     */
    protected function prepare(string $operation, array $attributes): array
    {

        return parent::prepare($operation, $attributes);
    }

    /**
     * @throws Exception
     */
}
