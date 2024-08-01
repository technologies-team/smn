<?php

namespace App\Http\Controllers;

use App\DTOs\Result;
use App\Http\Controllers\Controller;
use App\Http\Requests\FeedBackRequest;
use App\Http\Requests\OrderRequest;
use App\Http\Responses\SuccessResponse;
use App\Services\FeedBackService;
use App\Services\OrderService;
use Illuminate\Http\Request;

class OrderController extends CrudController
{
    protected OrderService $service;
    protected OrderRequest $Request;

    public function __construct(OrderService $service, OrderRequest $Request)
    {
        $this->service = $service;
        $this->Request = $Request;

    }

    /**
     * @throws \Exception
     */
    public function confirmOrder($id, OrderRequest $attribute): SuccessResponse
    {
        return $this->ok($this->service->createOrder($id, $attribute->all()));
    }
}
