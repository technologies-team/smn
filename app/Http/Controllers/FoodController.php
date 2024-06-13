<?php

namespace App\Http\Controllers;

use App\Http\Requests\Food\StoreRequest;
use App\Http\Responses\SuccessResponse;
use App\Services\FoodService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Session\Store;

class FoodController extends CrudController
{
    protected FoodService $service ;
    public function __construct(FoodService $bannerService){
        $this->service= $bannerService;
    }
    /**
     * @throws Exception
     */
    public function storeAll(StoreRequest $request): SuccessResponse
    {

   return parent::store($request);
    }

}
