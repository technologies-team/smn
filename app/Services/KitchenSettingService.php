<?php


namespace App\Services;


use App\DTOs\Result;
use App\Models\Banner;
use App\Models\Category;
use App\Models\KitchenSetting;
use Exception;
use Illuminate\Database\Eloquent\Builder;

class KitchenSettingService extends ModelService
{
    /**
     * storable field is a field which can be filled during creating the record
     */
    protected array $storables = [
        'kitchen_id',
        'delivery_type',
    ];

    /**
     * updatable field is a field which can be filled during updating the record
     */
    protected array $updatables = [
        'kitchen_id',
        'delivery_type',
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
        return KitchenSetting::query();
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
