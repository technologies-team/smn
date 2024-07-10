<?php

namespace App\Services;

use App\Kernel;
use App\Models\Banner;
use App\Models\Kitchen;
use Exception;
use Illuminate\Database\Eloquent\Builder;

class KitchenService extends ModelService
{

    /**
     * storable field is a field which can be filled during creating the record
     */
    protected array $storables = [
        'user_id',
        'title',
        'title_ar',
        'description',
        'description_ar',
        'phone',
        'mobile',
        'verified',
        'ready_to_delivery',
        'delivery_fee',
        'status',
        'active',
        'photo_id',
        'front_id',
        'back_id',
        'cover_id'
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
        return Kitchen::query();
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
