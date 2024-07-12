<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\KitchenRequest;
use App\Services\KitchenService;
use Illuminate\Http\Request;

class KitchenController extends CrudController
{
    protected KitchenService $service;
    protected KitchenRequest $Request;
    public function __construct(KitchenService $service,KitchenRequest $Request){
        $this->service=$service;
        $this->Request=$Request;
    }
}
