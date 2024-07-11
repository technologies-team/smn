<?php

namespace App\Http\Controllers;

use App\Http\Requests\FoodRequest;
use App\Services\FoodService;
use Exception;
class FoodController extends CrudController
{
    protected FoodService $service ;
    protected FoodRequest $Request;
    public function __construct(FoodService $bannerService,FoodRequest $Request){
        $this->service= $bannerService;
        $this->Request= $Request;
    }
    /**
     * @throws Exception
     */
}
