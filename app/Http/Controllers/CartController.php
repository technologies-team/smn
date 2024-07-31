<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\CartRequest;
use App\Http\Responses\SuccessResponse;
use App\Services\CartsService;
use Exception;
use Illuminate\Http\Request;

class CartController extends CrudController
{
    protected CartsService $service;
 protected CartRequest $Request;
    public function __construct(CartsService $service,CartRequest $Request){
        $this->service=$service;
        $this->Request=$Request;
    }

    /**
     * @throws Exception
     */
    public function addToCart($id,CartRequest $Request): SuccessResponse
    {
        return $this->ok($this->service->addToCart($id,$Request->all()));
    }

    public function viewCart($id): SuccessResponse
    {
        return $this->ok($this->service->viewCart($id));
    }
    public function clearCart($id): SuccessResponse
    {
        return $this->ok($this->service->clearCart($id));
    }

}
