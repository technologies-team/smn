<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Food\StoreRequest;
use App\Services\FoodService;
use Exception;
use Illuminate\Http\Request;

class OfferController extends CrudController
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
