<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\CartRequest;
use App\Services\CartsService;
use Illuminate\Http\Request;

class CartController extends CrudController
{
    protected CartsService $service;
 protected CartRequest $Request;
    public function __construct(CartsService $service,CartRequest $Request){
        $this->service=$service;
        $this->Request=$Request;
    }

}
