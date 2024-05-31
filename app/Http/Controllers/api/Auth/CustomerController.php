<?php

namespace App\Http\Controllers\api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginUserRequest;
use App\Http\Responses\SuccessResponse;
use App\Services\AuthService;
use Exception;

class CustomerController extends Controller
{
    private AuthService $service;

    public function __construct(AuthService $service)
    {
        $this->service = $service;
    }

    /**
     * Login
     *
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
    public function socialLogin(LoginUserRequest $request): SuccessResponse
    {
        OTP('+989389599530', ['otp_sms', 'mail', \App\Channels\CustomSMSChannel::class]);

        die(OTP()->send('+971509503511'));

        die(OTP('+971509503511'));
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
    public function delete( ): SuccessResponse
    {
        return $this->ok($this->service->destroy());
    }
}
