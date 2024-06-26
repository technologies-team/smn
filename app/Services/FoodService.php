<?php


namespace App\Services;


use App\DTOs\Result;
use App\Models\Banner;
use App\Models\Food;
use Exception;
use Illuminate\Database\Eloquent\Builder;

class FoodService extends ModelService
{
    /**
     * storable field is a field which can be filled during creating the record
     */
    protected array $storables = [

        'title', 'title_ar', 'description_ar', 'weight', 'deliverable', 'unit', 'preparation_time',
        'ingredients', 'price', 'kitchen_id', 'category_id', 'rewards',
        'photo_id', 'description'
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
    protected array $with = ['photo'];

    public function builder(): Builder
    {
        return Food::query();
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
