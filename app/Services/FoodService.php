<?php


namespace App\Services;


use App\DTOs\Result;
use App\Models\Banner;
use App\Models\Food;
use App\Models\Option;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class FoodService extends ModelService
{
    /**
     * storable field is a field which can be filled during creating the record
     */
    protected array $storables = [

        'title', 'title_ar', 'description_ar', 'weight', 'deliverable', 'unit', 'preparation_time',
        'ingredients', 'price', 'kitchen_id', 'category_id', 'rewards',
        'photo_id', 'description','status','tag_id'
    ];

    /**
     * updatable field is a field which can be filled during updating the record
     */
    protected array $updatables = [
        'title', 'title_ar', 'description_ar', 'weight', 'deliverable', 'unit', 'preparation_time',
        'ingredients', 'price', 'kitchen_id', 'category_id', 'rewards',
        'photo_id', 'description','status','tag_id'
    ];

    /**
     * searchable field is a field which can be searched for from keyword parameter in search method
     */
    protected array $searchables = ['title','title_ar'];
    /**
     *
     */
    protected array $with=['option','kitchen'];


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
public function store(array $attributes): Model
{

    $record= parent::store($attributes);
    if($record instanceof Food){
        if(isset($attributes['options'])){
            foreach ($attributes['options'] as $option){
                $options[$option["name"]]=$savedOption=$record->Option()->create($option);
                if($savedOption instanceof Option){
                    foreach ($option['choice'] as  $choice){
                        $options[$option["name"]][$choice['name']] = $savedOption->choice()->create($choice);
                    }
                }

            }
        }
    }
    return $record;
}
    /**
     * @throws Exception
     */
}
