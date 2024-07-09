<?php


namespace App\Services;


use App\DTOs\Result;
use App\Models\Banner;
use App\Models\Food;
use App\Models\Tag;
use Exception;
use Illuminate\Database\Eloquent\Builder;

class TagService extends ModelService
{
    /**
     * storable field is a field which can be filled during creating the record
     */
    protected array $storables = [
        'title','title_ar',
        'kitchen_id', 'description'
    ];

    /**
     * updatable field is a field which can be filled during updating the record
     */
    protected array $updatables = [
        'title','title_ar',
        'kitchen_id', 'description'
    ];

    /**
     * searchable field is a field which can be searched for from keyword parameter in search method
     */
    protected array $searchables = ['title','title_ar'];
    /**
     *
     */

    public function builder(): Builder
    {
        return Tag::query();
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
