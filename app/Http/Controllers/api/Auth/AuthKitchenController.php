<?php

namespace App\Http\Controllers\api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\CrudController;
use App\Http\Requests\KitchenRequest;
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

class AuthKitchenController extends CrudController
{
    protected AuthKitchenService $service;

public function __construct(AuthKitchenService $service)
{
    $this->service=$service;
}
    /**
     * Login
     *
     * @param LoginUserRequest $request
     * @return SuccessResponse
     * @throws Exception
     */
    public function login(LoginUserRequest $request): SuccessResponse
    {
        return $this->ok($this->service->login($request->all()));
    }
    /**
     * @throws Exception
     * @throws Throwable
     */
    public function register(RegisterRequest $request): SuccessResponse
    {
        return $this->ok($this->service->register($request->all()));
    }
    /**
     * @throws Exception
     */
    public function socialLogin(LoginUserRequest $request): SuccessResponse
    {
        return $this->ok($this->service->socialLogin($request->all()));
    }
    /**
     * Me
     *
     * @return SuccessResponse
     * @throws Exception
     */
    public function me(): SuccessResponse
    {

        return $this->ok($this->service->me());
    }
    /**
     * Logout
     *
     * @return SuccessResponse
     * @throws Exception
     */
    public function logout(): SuccessResponse
    {
        return $this->ok($this->service->logout());
    }
}
