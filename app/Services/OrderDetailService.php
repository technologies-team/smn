<?php

namespace App\Services;

use App\Http\Requests\OrderRequest;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class OrderDetailService extends ModelService
{
    /**
     * storable field is a field which can be filled during creating the record
     */
    protected array $storables = ['user_id','status'];

    /**
     * updatable field is a field which can be filled during updating the record
     */
    protected array $updatables = ['user_id','status'];

    /**
     * searchable field is a field which can be searched for from keyword parameter in search method
     */
    protected array $searchables = ['title',];
    /**
     *
     */
    protected array $with=[];

    public function builder(): Builder
    {
        return OrderDetail::query();
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

        $attributes['user_id']=$id;
        return parent::store($attributes);
    }

    /**
     * @throws Exception
     */
}
