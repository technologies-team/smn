<?php


namespace App\Services;


use App\DTOs\Result;
use App\Models\Banner;
use App\Models\Category;
use App\Models\ClientFeedback;
use App\Models\Order;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class OrderService extends ModelService
{
    /**
     * storable field is a field which can be filled during creating the record
     */
    protected array $storables = [

    ];

    /**
     * updatable field is a field which can be filled during updating the record
     */
    protected array $updatables = [

    ];

    /**
     * searchable field is a field which can be searched for from keyword parameter in search method
     */
    protected array $searchables = ['title',];
    /**
     *
     */
    protected array $with=['user','order'];

    public function builder(): Builder
    {
        return Order::query();
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
       $id= auth()->user()->getAuthIdentifier();


        return parent::store($attributes);
    }

    /**
     * @throws Exception
     */
}
