<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\CheckOtpRequest;
use App\Http\Requests\ResetPasswordRequest;
use App\Services\EmailService;
use Illuminate\Http\Request;

class EmailController extends Controller
{
    private EmailService $service;

    public function __construct(EmailService $service)
    {
        $this->service = $service;
    }

    public function sendEmail(Request $request): \App\Http\Responses\SuccessResponse
    {
        return $this->ok($this->service->sendWelcomeMail());
    }

    /**
     * @throws \Exception
     */
    public function resetPassword(Request $request): \App\Http\Responses\SuccessResponse
    {
        return $this->ok($this->service->sendResetPasswordMail($request->all()));
    }

    /**
     * @throws \Exception
     */
    public function confirmResetPassword(ResetPasswordRequest $request): \App\Http\Responses\SuccessResponse
    {
        return $this->ok($this->service->getToken($request->all()));
    }

    /**
     * @throws \Exception
     */
    public function checkOtp(CheckOtpRequest $request): \App\Http\Responses\SuccessResponse
    {
        return $this->ok($this->service->checkOtp($request->all()));
    }
}
