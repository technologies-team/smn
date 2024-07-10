<?php

namespace App\Http\Controllers;

use App\Http\Requests\Food\StoreRequest;
use App\Services\FoodService;
use Exception;
class FoodController extends CrudController
{
    protected FoodService $service ;
    protected StoreRequest $storeRequest;
    public function __construct(FoodService $bannerService){
        $this->service= $bannerService;
    }
    /**
     * @throws Exception
     */
}
