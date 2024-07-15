<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\FeedBackRequest;
use App\Services\FeedBackService;
use App\Services\OrderService;
use Illuminate\Http\Request;

class OrderController extends CrudController
{
    protected OrderService $service;
    protected FeedBackRequest $Request;
    public function __construct(OrderService $service,FeedBackRequest $Request){
        $this->service=$service;
        $this->Request=$Request;

    }
}
