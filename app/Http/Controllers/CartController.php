<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\CartsService;
use Illuminate\Http\Request;

class CartController extends Controller
{
    protected CartsService $service;
    public function __construct(CartsService $service){
        $this->service=$service;
    }
}
