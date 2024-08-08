<?php

namespace App\Http\Controllers\api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Responses\SuccessResponse;
use App\Services\AuthService;
use Exception;

class CustomerController extends Controller
{
    protected AuthService $service;

    public function __construct(AuthService $service)
    {
        $this->service = $service;
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
     * @throws \Throwable
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

    /**
     * @throws Exception
     */
    public function delete(): SuccessResponse
    {
        return $this->ok($this->service->delete());
    }
}
