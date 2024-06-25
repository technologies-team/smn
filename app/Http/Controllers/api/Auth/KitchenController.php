<?php

namespace App\Http\Controllers\api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\CrudController;
use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\RegisterKitchenRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Responses\SuccessResponse;
use App\Models\Kitchen;
use App\Services\AuthKitchenService;
use App\Services\AuthService;
use App\Services\KitchenService;
use Exception;
use Throwable;

class KitchenController extends CrudController
{
    protected KitchenService $service;
public function __construct(KitchenService $service)
{
    $this->service=$service;
}
}
