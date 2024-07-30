<?php

namespace App\Services;

use App\DTOs\Result;
use App\Kernel;
use App\Models\Banner;
use App\Models\Kitchen;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class KitchenService extends ModelService
{
    protected UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

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
     * searchable field is a field which can be searched for from keyword parameter in search method
     */
    protected array $searchables = ['title',];
    /**
     *
     */
    protected array $with = ['tags', 'user', 'photo', 'cover','idFront','idBack','foods'];

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
    public function save($id, array $attributes): Result
    {
        $kitchen=$this->find($id);
        if(isset($attributes["user"])){
            $this->userService->update($kitchen->user_id,$attributes["user"]);
        }
        return $this->ok($this->update($id, $attributes), 'records:save:done');

    }
    public function store(array $attributes): Model
    {
        $attributes['user_id']=auth()->id();
        return parent::store($attributes);
    }

    /**
     * @throws Exception
     */
}
